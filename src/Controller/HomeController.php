<?php
namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route(path: "", methods: ["GET"])]
    #[Route(path: "home",name: "home", methods: ["GET"])]
    public function home(): Response
    {
        return $this->render('home/home.html.twig');
    }


    #[Route(path: 'about', name: 'about', methods: ['GET'])]
    public function about(KernelInterface $kernel): Response
    {
        $team=json_decode(file_get_contents($kernel->getProjectDir().DIRECTORY_SEPARATOR.'data'.DIRECTORY_SEPARATOR.'team.json'), true);
        return $this->render('home/about.html.twig', compact('team'));
        /*
        $team = json_decode(file_get_contents(__DIR__ . '/../../data/team.json'), true);
        return $this->render('home/about.html.twig', ['team' => $team]);
        */
    }
}