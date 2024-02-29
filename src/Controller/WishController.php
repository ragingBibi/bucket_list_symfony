<?php

namespace App\Controller;

use App\Entity\Wish;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route(path: 'wishes/', name: 'wish_')]
class WishController extends AbstractController
{
    #[Route(path: '', name: 'list', methods: ['GET'])]
    public function list(EntityManagerInterface $entityManager, Request $request): Response {

        // Pagination
        $elementsByPage = 10;
        if (($page = $request->get('p', 1)) < 1) {
            return $this->redirectToRoute('wish_list');
        }

        // Nombre d'éléments
        $total = $entityManager->getRepository(Wish::class)->count(['isPublished' => true]);

        // Requête pour une page
        $wishes = $entityManager->getRepository(Wish::class)->findBy(
            ['isPublished' => true],
            ['dateCreated' => 'DESC'],
            $elementsByPage, $elementsByPage * ($page - 1)
        );

        return $this->render('wish/list.html.twig', compact('wishes', 'total', 'elementsByPage'));
    }

    /*
    #[Route(path: '{id}', name: 'detail', requirements: ['id' => '[1-9]\d*'], methods: ['GET'])]
    public function detail(?Wish $wish): Response {

        if (!$wish || !$wish->isPublished()) {
            throw $this->createNotFoundException('Wish not found !');
        }

        return $this->render('wish/detail', compact('wish'));
    }
*/
    #[Route(path: '{id}', name: 'details', requirements: ['id' => '[1-9]\d*'], methods: ['GET'])]
    public function details(int $id, EntityManagerInterface $entityManager): Response {

        $wish = $entityManager->getRepository(Wish::class)->findOneBy(
            ['id' => $id, 'isPublished' => true]
        );

        if (!$wish) {
            throw $this->createNotFoundException('Wish not found !');
        }

        return $this->render('wish/detail.html.twig', compact('wish'));
    }
}