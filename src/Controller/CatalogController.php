<?php 

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CatalogController extends AbstractController
{
    #[Route("/")]
    public function index(): Response
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

    #[Route('/browse/{slug}')]
    public function browse(string $slug = null): Response
    {
        $title = ($slug) ? 'Category: '.ucwords(str_replace('-', ' ', $slug)): 'All Categories';

        return $this->render('catalog/index.html.twig', [
            'title' => $title
        ]);
    }

}