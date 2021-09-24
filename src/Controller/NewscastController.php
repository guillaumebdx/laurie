<?php

namespace App\Controller;

use App\Entity\Newscast;
use App\Form\NewscastType;
use App\Repository\NewscastRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/newscast")
 */
class NewscastController extends AbstractController
{
    /**
     * @Route("/", name="newscast_index", methods={"GET"})
     */
    public function index(NewscastRepository $newscastRepository): Response
    {
        return $this->render('newscast/index.html.twig', [
            'newscasts' => $newscastRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="newscast_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $newscast = new Newscast();
        $form = $this->createForm(NewscastType::class, $newscast);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($newscast);
            $entityManager->flush();

            return $this->redirectToRoute('newscast_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('newscast/new.html.twig', [
            'newscast' => $newscast,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="newscast_show", methods={"GET"})
     */
    public function show(Newscast $newscast): Response
    {
        return $this->render('newscast/show.html.twig', [
            'newscast' => $newscast,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="newscast_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Newscast $newscast): Response
    {
        $form = $this->createForm(NewscastType::class, $newscast);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('newscast_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('newscast/edit.html.twig', [
            'newscast' => $newscast,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="newscast_delete", methods={"POST"})
     */
    public function delete(Request $request, Newscast $newscast): Response
    {
        if ($this->isCsrfTokenValid('delete'.$newscast->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($newscast);
            $entityManager->flush();
        }

        return $this->redirectToRoute('newscast_index', [], Response::HTTP_SEE_OTHER);
    }
}
