<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    #[Route('/{_locale}/login', name: 'app_login')]
    public function login(AuthenticationUtils $auth_utils): Response
    {
        return $this->render('security/login.html.twig', [
            'error' => $auth_utils->getLastAuthenticationError(),
            'last_username' => $auth_utils->getLastUsername(),
        ]);
    }

    #[Route("/logout", name: 'app_logout')]
    public function logout()
    {
        throw new \Exception('logout() should never be reached');
    }
}
