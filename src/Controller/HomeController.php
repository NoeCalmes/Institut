<?php

namespace App\Controller;

use App\Repository\StageRepository;
use App\Repository\ProfesseurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'home')]
    public function index(
        StageRepository $stageRepo,
        ProfesseurRepository $profRepo
    ): Response {
        // 1) Récupérer tous les stages
        $stages = $stageRepo->findAll();

        // 2) Récupérer tous les professeurs
        $professeurs = $profRepo->findAll();

        // 3) Rendre la vue "home.html.twig"
        return $this->render('home.html.twig', [
            'stages' => $stages,
            'professeurs' => $professeurs
        ]);
    }
}
