<?php

namespace App\Controller;

use App\Entity\Page;
use App\Repository\PageRepository;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PageController extends AbstractController
{
    #[Route(
        path: '/{_locale}/page/{slug}',
        name: 'app_page',
        requirements: [
            '_locale' => 'en|es',
        ],
    )]
    public function index($slug = null, PageRepository $repo_page): Response
    {
        
        $obj_row = $repo_page->getPageBySlug($slug);
        $obj_row_translation = $obj_row->getTranslation();

        return $this->render('page/index.html.twig', [
            'obj_row' => $obj_row,
            'obj_row_translation' => $obj_row_translation,
        ]);

    }


    #[Route(
        path: '/{_locale}/catalog/{slug}/{brand}/{category}',
        name: 'app_catalog',
        requirements: [
            '_locale' => 'en|es',
        ],
    )]
    public function catalog(Request $request, $slug = null, $brand = null, $category = null, PageRepository $repo_page, ProductRepository $repo_product): Response
    {

        $obj_row = $repo_page->getPageBySlug($slug);
        $obj_row_translation = $obj_row->getTranslation();
        $arr_catalog_data = $repo_product->getCatalogData($brand, $category);

        $arr_filter_data = $repo_product->getFilterData(); 

        //$request->getSession()->set('searchParams', []);
        
        return $this->render('page/catalog.html.twig', [
            'filter_data' => $arr_filter_data,
            'obj_row' => $obj_row,
            'obj_row_translation' => $obj_row_translation,
            'arr_catalog_data' => $arr_catalog_data,
            'search_params' => [],
        ]);        

    }
}
