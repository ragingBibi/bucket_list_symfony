<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class WishController extends AbstractController
{
    #[Route(path: "wish", methods: ["GET"])]
    public function index(): Response
    {
        return $this->render('wish/index.html.twig', [
            'controller_name' => 'WishController',
        ]);
    }

    #[Route(path: "list", methods: ["GET"])]
    public function list(): Response
    {
        return $this->render('wish/list.html.twig', [
            'controller_name' => 'WishController',
        ]);
    }

    #[Route(path: "detail", methods: ["GET"])]
    public function detail(): Response
    {

        return $this->render('wish/detail.html.twig', [
            'controller_name' => 'WishController',
        ]);
    }
}
