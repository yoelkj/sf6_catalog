<?php 

namespace App\Controller;

use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CatalogController extends AbstractController
{

    #[Route("/", name: 'app_homepage_redir', requirements: ['_locale' => 'en|es'])]
    public function index(): Response
    {
        return $this->redirect($this->generateUrl('app_homepage'));
    }

    #[Route("/{_locale}/", name: 'app_homepage', requirements: ['_locale' => 'en|es'])]
    public function homepage(): Response
    {

        $rows = [
            ['name' => 'Gangsta\'s Paradise', 'desc' => 'Coolio'],
            ['name' => 'Waterfalls', 'desc' => 'TLC'],
            ['name' => 'Creep', 'desc' => 'Radiohead'],
            ['name' => 'Kiss from a Rose', 'desc' => 'Seal'],
            ['name' => 'On Bended Knee', 'desc' => 'Boyz II Men'],
            ['name' => 'Fantasy', 'desc' => 'Mariah Carey'],
        ];

        return $this->render('catalog/index.html.twig', [
            'title' => 'Catalog home page',
            'rows' => $rows
        ]);
    }

    #[Route('/browse/{slug}', name: 'app_browse')]
    public function browse(string $slug = null): Response
    {
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