<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DifficultyLevelsController extends AbstractController
{
    /**
     * @Route("/difficulties", name="difficulty_levels")
     */
    public function index(): Response
    {
        return $this->render('difficulty_levels/index.html.twig', [
            'controller_name' => 'DifficultyLevelsController',
        ]);
    }
}
