<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LinesController extends AbstractController
{
    /**
     * @Route("/lines", name="lines")
     */
    public function index(): Response
    {
        return $this->render('lines/index.html.twig', [
            'controller_name' => 'LinesController',
        ]);
    }
}
