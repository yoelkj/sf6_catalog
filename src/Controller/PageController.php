<?php

namespace App\Controller;

use App\Entity\Page;
use App\Repository\BrandRepository;
use App\Repository\PageRepository;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Pagerfanta\Doctrine\ORM\QueryAdapter;
use Pagerfanta\Pagerfanta;

class PageController extends AbstractController
{

    #[Route("/", name: 'app_homepage')]
    #[Route("/{_locale}/", name: 'app_homepage_local', requirements: ['_locale' => 'en|es'])]
    public function index(PageRepository $repo_page): Response
    {
        
        $obj_page = $repo_page->findOneByIsHomepage(true); //Load homepage configuration
        $obj_page = ($obj_page) ?$obj_page : $repo_page->find(1);

        if ($obj_page->getIsCatalog()) throw $this->createNotFoundException('It is not possible to use a catalog page as a home page');

        $obj_widgets = $obj_page->getWidgets(); 
        
        return $this->render('page/home.html.twig', [
            'obj_widgets' => $obj_widgets
        ]);
    }

    #[Route(
        path: '/{_locale}/page/{slug}',
        name: 'app_page',
        requirements: [
            '_locale' => 'en|es',
        ],
    )]
    public function page($slug = null, PageRepository $repo_page): Response
    {
        
        $obj_row = $repo_page->getPageBySlug($slug);
        $obj_row_translation = $obj_row->getTranslation();

        $obj_widgets = $obj_row->getWidgets();

        return $this->render('page/index.html.twig', [
            'obj_row' => $obj_row,
            'obj_row_translation' => $obj_row_translation,
            'obj_widgets' => $obj_widgets
        ]);

    }

    #[Route(
        path: '/{_locale}/catalog/{slug}/{brand}',
        name: 'app_catalog',
        requirements: [
            '_locale' => 'en|es',
        ],
    )]
    public function catalog(Request $request, $slug = null, $brand = null, BrandRepository $repo_brand, PageRepository $repo_page, ProductRepository $repo_product): Response
    {

        $obj_row = $repo_page->getPageBySlug($slug);
        $obj_row_translation = $obj_row->getTranslation();
        
        $obj_brand = ($brand && $brand != 'all' && $brand != 'todos') ? $repo_brand->findOneBySlug($brand) : null;
        
        $obj_qb = $repo_product->getCatalogData(($obj_brand)?["cbo_brand" => $obj_brand->getId()]:[], 1);
        $data = new Pagerfanta(new QueryAdapter($obj_qb));
        $data->setMaxPerPage(8);

        $arr_data['data'] = $data;
        $arr_data['brand'] = $obj_brand;

        
        $arr_filter_data = $repo_product->getFilterData();


        $obj_widgets = $obj_row->getWidgets();

        //$request->getSession()->set('searchParams', []);
        
        return $this->render('page/catalog.html.twig', [
            'filter_data' => $arr_filter_data,
            'obj_row' => $obj_row,
            'obj_row_translation' => $obj_row_translation,
            'arr_catalog_data' => $arr_data,
            'search_params' => [],
            'obj_widgets' => $obj_widgets
        ]);

    }

    #[Route(
        path: '/{_locale}/product/{slug}',
        name: 'app_product',
        requirements: [
            '_locale' => 'en|es',
        ],
    )]
    public function product(Request $request, $slug = null, ProductRepository $repo_product): Response
    {

        $obj_row = $repo_product->getRowBySlug($slug);
        $obj_row_translation = $obj_row->getTranslation();

        $obj_widgets = $obj_row->getWidgets();

        return $this->render('page/product.html.twig', [
            'obj_row' => $obj_row,
            'obj_row_translation' => $obj_row_translation,
            'obj_widgets' => $obj_widgets,
        ]);

    }

    #[Route(
        path: '/{_locale}/ajax-catalog',
        name: 'ajax_app_products',
        requirements: [
            '_locale' => 'en|es',
        ],
    )]
    public function ajaxGetProducts(Request $request, ProductRepository $repo_product){

        if ($request->isXmlHttpRequest()) {
            
            $params = $request->request->all();

            $obj_qb = $repo_product->getCatalogData($params, 1);
            $pager = new Pagerfanta(new QueryAdapter($obj_qb));
            $pager->setMaxPerPage(8);
            $pager->setCurrentPage((isset($params['page']) && $params['page']) ? $params['page'] : 1);

            return $this->render('page/_products.html.twig', [
                'data' => $pager
            ]);

        }

    }
}
