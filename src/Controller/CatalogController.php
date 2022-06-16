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
        return new Response('Catalog homepage');
    }

    #[Route('/browse/{slug}')]
    public function browse(string $slug = null): Response
    {

        $title = ($slug) ? 'Category: '.ucwords(str_replace('-', ' ', $slug)): 'All Categories';

        return new Response($title);
    }
    
}