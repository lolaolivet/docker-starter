<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Feedback;
use App\Form\Type\FeedbackType;

class FeedbackController extends AbstractController
{
    /**
     * @Route("/feedback", name="feedback")
     */
    public function index(): Response
    {

        $feedbacks = $this->getDoctrine()->getRepository(Feedback::class)->findAll();

        return $this->render('feedback/index.html.twig', [
            'controller_name' => 'FeedbackController',
            'feedbacks' => $feedbacks,
        ]);
    }
}
