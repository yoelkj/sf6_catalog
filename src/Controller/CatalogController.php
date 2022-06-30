<?php 

namespace App\Controller;

use App\Repository\PageRepository;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

//use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
//use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

#class CatalogController extends AbstractController
class CatalogController extends BaseController
{

    /*
    #[Route("/", name: 'app_homepage_redir', requirements: ['_locale' => 'en|es'])]
    public function index(): Response
    {
        return $this->redirect($this->generateUrl('app_homepage'));
    }
    */
    
    #[Route("/", name: 'app_homepage')]
    #[Route("/{_locale}/", name: 'app_homepage_local', requirements: ['_locale' => 'en|es'])]
    public function homepage(PageRepository $repo_page): Response
    {
        $obj_page = $repo_page->find(1);//Load homepage configuration
        
        $obj_widgets = $obj_page->getWidgets(); 
        
        return $this->render('catalog/index.html.twig', [
            'obj_widgets' => $obj_widgets
        ]);
    }

    
    #[Route('/{_locale}/browse/{slug}', name: 'app_browse', requirements: ['_locale' => 'en|es'])]
    public function browse(string $slug = null): Response
    {
        //HttpClientInterface $httpClient: install composer require symfony/http-client 
        //CacheInterface $cache
        /*
        $mixes = $cache->get('mixes_data', function(CacheItemInterface $cacheItem) use ($httpClient) {
            $cacheItem->expiresAfter(5);
            $response = $httpClient->request('GET', 'https://raw.githubusercontent.com/SymfonyCasts/vinyl-mixes/main/mixes.json');
            return $response->toArray();
        });
        */

        /*
            #[Security("is_granted('ROLE_ADMIN') and is_granted('ROLE_FRIENDLY_USER')")]
            #[IsGranted('ROLE_ADMIN')]   
        */

        //$this->denyAccessUnlessGranted('ROLE_USER');
        //if (!$this->isGranted('ROLE_ADMIN')) {
        //    throw $this->createAccessDeniedException('No access for you!');
        //}


        $title = ($slug) ? 'Category: '.ucwords(str_replace('-', ' ', $slug)): 'All Categories';

        return $this->render('catalog/browse.html.twig', [
            'title' => $title
        ]);
    }

    #[Route('/api/products/{id<\d+>}', methods: ['GET'], name: 'app_ajax_produc_detail')]
    public function getProduct(int $id, LoggerInterface $logger): Response
    {
        // TODO query the database
        $data = [
            'id' => $id,
            'name' => 'product name',
            'url' => 'https://symfonycasts.s3.amazonaws.com/sample.mp3',
        ];

        $logger->info('Returning API response for product {data}', [
            'product' => $id,
        ]);

        return $this->json($data);
    }


}