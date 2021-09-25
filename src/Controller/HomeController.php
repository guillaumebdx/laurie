<?php

namespace App\Controller;

use App\Repository\NewscastRepository;
use App\Repository\SocialRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(NewscastRepository $newscastRepository, SocialRepository $socialRepository): Response
    {
        return $this->render('home/index.html.twig', [
            'newscasts' => $newscastRepository->findAll(),
        ]);
    }
}
