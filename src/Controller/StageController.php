<?php

namespace App\Controller;

use App\Entity\Stage;
use App\Form\StageType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StageController extends AbstractController
{
    #[Route('/stage/new', name: 'stage_new')]
    public function new(Request $request, EntityManagerInterface $em): Response
    {

        if (!$this->isGranted('ROLE_ADMIN')) {
            throw $this->createAccessDeniedException('Accès réservé aux admins');
        }

        // Créer un nouvel objet Stage
        $stage = new Stage();

        // Construire le formulaire (on le définit juste après)
        $form = $this->createForm(StageType::class, $stage);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // Sauvegarde en base
            $em->persist($stage);
            $em->flush();

            // Redirection post-création
            return $this->redirectToRoute('home');
        }

        // Afficher le formulaire
        return $this->render('stage/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/stage/{id}/delete', name: 'stage_delete', methods: ['GET'])]
    public function delete(Stage $stage, EntityManagerInterface $em)
    {

        if (!$this->isGranted('ROLE_ADMIN')) {
            throw $this->createAccessDeniedException('Accès refusé');
        }

        // Suppression
        $em->remove($stage);
        $em->flush();

        return $this->redirectToRoute('home');
    }

    
    #[Route('/stage/{id}/edit', name: 'stage_edit', methods: ['GET','POST'])]
    public function edit(Stage $stage, Request $request, EntityManagerInterface $em): Response
    {
        // Vérifier qu'on est admin
        if (!$this->isGranted('ROLE_ADMIN')) {
            throw $this->createAccessDeniedException('Accès refusé');
        }

        // Créer un formulaire basé sur StageType, mais pré-rempli avec l'objet $stage
        $form = $this->createForm(StageType::class, $stage);

        // Gérer la requête (POST) soumise
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();

            // Rediriger vers la liste (ou ailleurs)
            return $this->redirectToRoute('home');
        }

        // Afficher le template twig, avec le formulaire
        return $this->render('stage/edit.html.twig', [
            'form' => $form->createView(),
            'stage' => $stage
        ]);
    }

}
