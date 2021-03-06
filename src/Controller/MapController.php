<?php

namespace App\Controller;

use App\Entity\Representation;
use App\Form\RepresentationType;
use App\Repository\RepresentationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin")
 */
class MapController extends AbstractController
{
    /**
     * @Route("/map", name="map")
     */
    public function index(Request $request,
                          EntityManagerInterface $entityManager,
                          RepresentationRepository $representationRepository): Response
    {
        if ($request->getMethod() === 'POST') {
            $city = $request->request->get('city');
            $date = $request->request->get('date');
            $url = $request->request->get('url');
            $block = $request->request->get('block');

            $representation = new Representation();
            $representation->setCity($city)->setDate($date)->setUrl($url)->setBlock($block);
            $entityManager->persist($representation);
            $entityManager->flush();
        }
        $representations = $representationRepository->findBy([], ['city' => 'ASC']);
        $blockRepresentations = [];
        foreach ($representations as $representation) {
            $blockRepresentations[$representation->getBlock()] = $representation;
        }
        return $this->render('map/index.html.twig', [
            'representations' => $representations,
            'block_representations' => $blockRepresentations,
            'map_context' => 'admin',
        ]);
    }

    /**
     * @Route("/delete/{id}", name="delete_representation")
     */
    public function deleteRepresentation(Representation $representation, EntityManagerInterface $entityManager)
    {
        $entityManager->remove($representation);
        $entityManager->flush();
        return $this->redirectToRoute('map');
    }
}
