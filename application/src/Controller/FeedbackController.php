<?php

namespace App\Controller;

use App\Repository\FeedbackRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Feedback;

class FeedbackController extends AbstractController
{
    private FeedbackRepository $feedbackRepository;

    private EntityManagerInterface $entityManager;

    public function __construct(FeedbackRepository $feedbackRepository, EntityManagerInterface $entityManager) {
        $this->feedbackRepository = $feedbackRepository;
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/feedback", name="feedback")
     */
    public function index(): Response
    {

        $feedbacks = $this->feedbackRepository->findAll();

        return $this->render('feedback/index.html.twig', [
            'controller_name' => 'FeedbackController',
            'feedbacks' => $feedbacks,
        ]);
    }

    /**
     * @Route("/feedback/{id}", name="feedback_delete", methods={"DELETE"})
     */
    public function deleteFeedback(Feedback $feedback): Response
    {
        if ($feedback instanceof Feedback) {
            $this->entityManager->remove($feedback);
            $this->entityManager->flush();
            return $this->json(['message' => 'OK'], 200, []);
        }
        return $this->json(['message' => 'This feedback does not exists'],  404, []);

    }
}
