<?php

namespace App\Controller;

use App\Form\Type\LineEditType;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Lines;
use App\Entity\Feedback;
use App\Form\Type\FeedbackType;
use App\Repository\LinesRepository;
use Symfony\Component\Serializer\SerializerInterface;

class LinesController extends AbstractController
{

    private LinesRepository $linesRepository;

    private EntityManagerInterface $entityManager;

    public function __construct(LinesRepository $linesRepository, EntityManagerInterface $entityManager)
    {
        $this->linesRepository = $linesRepository;
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/lines", name="lines")
     */
    public function index(): Response
    {

        $lines = $this->linesRepository->findAll();

        return $this->render('lines/index.html.twig', [
            'controller_name' => 'LinesController',
            'lines' => $lines,
        ]);
    }

    /**
     * @Route("/lines/{id}", name="line_show")
     */
    public function show(Lines $line, Request $request): Response {

        $feedback = new Feedback();
        $form = $this->createForm(FeedbackType::class, $feedback);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $feedbackFormData = $form->getData();
            $feedbackFormData->setLine($line);

            $this->entityManager->persist($feedbackFormData);
            $this->entityManager->flush();

            $feedback = new Feedback();
            $form = $this->createForm(FeedbackType::class, $feedback);
        }
        
        return $this->render('line/index.html.twig', [
            'line' => $line,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/line/{id}", name="line_edit")
     * @IsGranted("ROLE_ADMIN")
     */
    public function edit(Lines $line, Request $request): Response {

        $form = $this->createForm(LineEditType::class, $line, ['data' => $line]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $lineFormData = $form->getData();
            $difficulties = $line->getDifficulties();

            foreach ($difficulties as $difficulty) {
                $lineFormData->addDifficulty($difficulty);
            }

            $this->entityManager->persist($lineFormData);
            $this->entityManager->flush();
        }

        return $this->render('line/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
