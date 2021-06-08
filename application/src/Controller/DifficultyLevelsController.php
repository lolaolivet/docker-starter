<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\DifficultyLevel;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class DifficultyLevelsController extends AbstractController
{
    /**
     * @Route("/difficulties", name="difficulty_levels")
     */
    public function index(): Response
    {

        $difficultyLevels = $this->getDoctrine()->getRepository(DifficultyLevel::class)->findAll();

        return $this->render('difficulty_levels/index.html.twig', [
            'controller_name' => 'DifficultyLevelsController',
            'difficulty_levels' => $difficultyLevels,
        ]);
    }
}
