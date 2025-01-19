<?php

namespace App\Controller;

use App\Entity\Professeur;
use App\Form\ProfesseurType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfesseurController extends AbstractController
{
    #[Route('/professeurs', name: 'professeur_index', methods: ['GET'])]
    public function index(EntityManagerInterface $em): Response
    {

        if (!$this->isGranted('ROLE_PROF')) {
            throw $this->createAccessDeniedException('Accès refusé');
        }

        $professeurs = $em->getRepository(Professeur::class)->findAll();

        return $this->render('professeur/index.html.twig', [
            'professeurs' => $professeurs,
        ]);
    }

    #[Route('/professeurs/new', name: 'professeur_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        if (!$this->isGranted('ROLE_ADMIN')) {
            throw $this->createAccessDeniedException('Accès réservé aux admins');
        }

        $professeur = new Professeur();
        $form = $this->createForm(ProfesseurType::class, $professeur);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // Sauvegarder en base
            $em->persist($professeur);
            $em->flush();

            return $this->redirectToRoute('home');
        }

        return $this->render('professeur/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/stage/{id}/delete', name: 'professeur_delete', methods: ['GET'])]
    public function delete(Professeur $professeur, EntityManagerInterface $em)
    {

        if (!$this->isGranted('ROLE_ADMIN')) {
            throw $this->createAccessDeniedException('Accès refusé');
        }
    
        $em->remove($professeur);
        $em->flush();
    
        return $this->redirectToRoute('home');
    }



    #[Route('/professeur/{id}/edit', name: 'professeur_edit', methods: ['GET','POST'])]
    public function edit(Professeur $professeur, Request $request, EntityManagerInterface $em): Response
    {

        if (!$this->isGranted('ROLE_ADMIN')) {
            throw $this->createAccessDeniedException('Accès refusé');
        }

        $form = $this->createForm(ProfesseurType::class, $professeur);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            return $this->redirectToRoute('home');
        }


        return $this->render('professeur/edit.html.twig', [
            'form' => $form->createView(),
            'professeur' => $professeur
        ]);
    }

    
}


