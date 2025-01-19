<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
// Import nécessaire pour récupérer l’erreur de login
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    #[Route('/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // 1) Récupérer l’erreur de login (s’il y en a une)
        $error = $authenticationUtils->getLastAuthenticationError();

        // 2) Récupérer le dernier nom d’utilisateur saisi (pour pré-remplir le champ)
        $lastUsername = $authenticationUtils->getLastUsername();

        // 3) Transmettre ces infos au template Twig
        return $this->render('login.html.twig', [
            'error'         => $error,
            'last_username' => $lastUsername
        ]);
    }

    #[Route('/logout', name: 'app_logout')]
    public function logout(): void
    {
        // C'est géré automatiquement par Symfony.
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}
