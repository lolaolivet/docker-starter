<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Lines;
use App\Entity\Feedback;

class LinesController extends AbstractController
{
    /**
     * @Route("/lines", name="lines")
     */
    public function index(): Response
    {

        $lines = $this->getDoctrine()->getRepository(Lines::class)->findAll();

        return $this->render('lines/index.html.twig', [
            'controller_name' => 'LinesController',
            'lines' => $lines,
        ]);
    }

    /**
     * @Route("/lines/{id}", name="line_show")
     */
    public function show(int $id): Response {
    

        $line = $this->getDoctrine()
            ->getRepository(Lines::class)
            ->find($id);

        $feedbacks = $this->getDoctrine()->getRepository(Feedback::class)->findBy([
            'line' => $id,
        ]);

        
        return $this->render('line/index.html.twig', [
            'line' => $line,
            'feedbacks' => $feedbacks
        ]);
    }
}
