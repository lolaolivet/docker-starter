<?php
namespace App\Controller;

use App\Entity\Lines;
use App\Repository\LinesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * @Route("/api", name="api")
 */
class LinesApiController extends AbstractController
{

    private $linesRepository;

    private $entityManager;

    public function __construct(LinesRepository $linesRepository, EntityManagerInterface $entityManager)
    {
        $this->linesRepository = $linesRepository;
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/lines", name="api_lines", methods={"GET"})
     */
    public function index(): Response
    {
        $lines = $this->linesRepository->findAll();

        return $this->json($lines, 200, [], ['groups' => 'list_lines']);
    }

    /**
     * @Route("/lines/{id}", name="api_show_line", methods={"GET"})
     */
    public function show(Lines $line): Response
    {
        return $this->json($line, 200, [], ['groups' => 'show_line']);
    }

}