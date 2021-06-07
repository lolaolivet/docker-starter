<?php

namespace App\Controller;

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

    private LinesRepository $linesRepository;

    public function __construct(LinesRepository $linesRepository)
    {
        $this->linesRepository = $linesRepository;
    }

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
    public function show(int $id, Request $request): Response {
    

        $line = $this->linesRepository
            ->find($id);

        $feedback = new Feedback();
        $feedback->setDate(new \DateTime('today'));

        $form = $this->createForm(FeedbackType::class, $feedback);
        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $res = $form->getData();

            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!

            $res->setLine($line);

            // var_dump($res);
            // $res->setDate((string) $form->getData('date'));

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($res);
            $entityManager->flush();

            // return $this->redirectToRoute("line/{$id}");
        }
        
        return $this->render('line/index.html.twig', [
            'line' => $line,
            'form' => $form->createView(),
        ]);
    }
}
