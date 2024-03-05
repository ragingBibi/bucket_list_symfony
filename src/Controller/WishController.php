<?php

namespace App\Controller;

use App\Entity\Wish;
use App\Form\WishType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route(path: 'wishes/', name: 'wish_')]
class WishController extends AbstractController
{
    #[Route(path: '', name: 'list', methods: ['GET'])]
    public function list(EntityManagerInterface $entityManager, Request $request): Response
    {

        // Pagination
        $maxPerPage = 10;
        if (($page = $request->get('p', 1)) < 1) {
            return $this->redirectToRoute('wish_list');
        }

        // Nombre d'éléments
        $count = $entityManager->getRepository(Wish::class)->count(['isPublished' => true]);

        // Requête pour une page
        $wishes = $entityManager->getRepository(Wish::class)->getWishesByPage($page, $maxPerPage);

        // Vérification de la page
        if ($page !== 1 && empty($wishes)) {
            return $this->redirectToRoute('wish_list');
        }

        return $this->render('wish/list.html.twig', compact('wishes', 'count', 'maxPerPage'));
    }

    #[Route(path: '{id}', name: 'detail', requirements: ['id' => '[1-9]\d*'], methods: ['GET'])]
    public function details(int $id, EntityManagerInterface $entityManager): Response
    {
        $wish = $entityManager->getRepository(Wish::class)->getWishById($id);
        if (!$wish) {
            throw $this->createNotFoundException('Wish not found !');
        }

        return $this->render('wish/detail.html.twig', compact('wish'));
    }

    /*#[Route(path: '{id}', name: 'details', requirements: ['id' => '[1-9]\d*'], methods: ['GET'])]
    public function details(?Wish $wish): Response {

        // Vérification du souhait
        if (!$wish || !$wish->isPublished()) {
            throw $this->createNotFoundException('Wish not found !');
        }

        return $this->render('wish/details.html.twig', compact('wish'));
    }*/

    /*#[Route(path: '{id}', name: 'details', requirements: ['id' => '[1-9]\d*'], methods: ['GET'])]
    public function details(int $id): Response {

        $wish = $entityManager->getRepository(Wish::class)->findOneBy(
            ['id' => $id, 'isPublished' => true]
        );

        if (!$wish) {
            throw $this->createNotFoundException('Wish not found !');
        }

        return $this->render('wish/details.html.twig', compact('wish'));
    }*/

    #[Route('create', name: 'create')]
    public function create(Request $request, EntityManagerInterface $em): Response
    {
        $wish = new Wish();

        $form = $this->createForm(WishType::class, $wish);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //persist le em
            $em->persist($wish);
            //flush le em
            $em->flush();

            $this->addFlash('success', 'Un souhait a été enregistré, vive Najat!!');

            return $this->redirectToRoute('wish_detail', ['id' => $wish->getId()]);

        }

        return $this->render('wish/new-wish.html.twig', [
            'wish_form' => $form
        ]);
    }
}
