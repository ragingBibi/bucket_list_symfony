<?php
namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route(path: "", methods: ["GET"])]
    #[Route(path: "home", methods: ["GET"])]
    public function home(): Response
    {
        return $this->render('home/home.html.twig');
    }

    #[Route(path: "about", methods: ["GET"])]
    public function about(): Response
    {
        return $this->render('home/about.html.twig');
    }
}