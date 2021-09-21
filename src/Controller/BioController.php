<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BioController extends AbstractController
{
    /**
     * @Route("/bio", name="bio")
     */
    public function index(): Response
    {
        return $this->render('bio/index.html.twig', [
            'controller_name' => 'BioController',
        ]);
    }
}
