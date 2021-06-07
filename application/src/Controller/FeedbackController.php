<?php

namespace App\Controller;

use App\Repository\FeedbackRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Feedback;

class FeedbackController extends AbstractController
{
    private $feedbackRepository;

    public function __construct(FeedbackRepository $feedbackRepository) {
        $this->feedbackRepository = $feedbackRepository;
    }

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

    /**
     * @Route("/feedback/{id}", name="feedback_delete", methods={"DELETE"})
     */
    public function deleteFeedback(int $id): Response
    {
        $feedback = $this->feedbackRepository->find($id);

        if ($feedback instanceof Feedback) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($feedback);
            $entityManager->flush();
            return $this->json(['response' => 'OK']);
        } else {
            throw new BadRequestHttpException('Message', null, 404);
        }

    }
}
