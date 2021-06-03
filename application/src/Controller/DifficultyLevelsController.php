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
    public function index(ValidatorInterface $validator): Response
    {

        // $difficultyLevel = new DifficultyLevel();
        // $difficultyLevel->setDifficulty('Mega dur');
        // $difficultyLevel->setNotationFr('MD');
        // $difficultyLevel->setNotationDe('Z');
        // $difficultyLevel->setColour('#000000');

        $difficultyLevels = $this->getDoctrine()->getRepository(DifficultyLevel::class)->findAll();

        if (!$difficultyLevels) {
            throw $this->createNotFoundExeption('NOPE'); 
        }


        // $errors = $validator->validate($difficultyLevel);
        
        // if (count($errors) > 0) {
        //     $errorsString = (string) $errors;

        //     return new Response($errorsString);
        // }

        // dd($difficultyLevels);

        

        return $this->render('difficulty_levels/index.html.twig', [
            'controller_name' => 'DifficultyLevelsController',
            'difficulty_levels' => $difficultyLevels,
        ]);
    }       
}
