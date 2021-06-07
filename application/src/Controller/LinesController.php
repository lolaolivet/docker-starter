<?php

namespace App\Controller;

use App\Form\Type\LineEditType;
use phpDocumentor\Reflection\Types\Integer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Lines;
use App\Entity\Feedback;
use App\Form\Type\FeedbackType;
use App\Repository\LinesRepository;

class LinesController extends AbstractController
{

    private $linesRepository;

    public function __construct(LinesRepository $linesRepository)
    {
        $this->linesRepository = $linesRepository;
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
    public function show(int $id, Request $request): Response {
    

        $line = $this->linesRepository
            ->find($id);

        $feedback = new Feedback();
        $feedback->setDate(new \DateTime('today'));

        $form = $this->createForm(FeedbackType::class, $feedback);
        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $feddbackFormData = $form->getData();

            $feddbackFormData->setLine($line);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($feddbackFormData);
            $entityManager->flush();
        }
        
        return $this->render('line/index.html.twig', [
            'line' => $line,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/line/{id}", name="line_edit")
     */
    public function edit(int $id): Response {
        $line = $this->linesRepository->find($id);

        $form = $this->createForm(LineEditType::class, $line);

        return $this->render('line/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
