<?php
namespace App\Controller;

use App\Entity\Lines;
use App\Repository\DifficultyLevelRepository;
use App\Repository\LinesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * @Route("/api", name="api")
 */
class LinesApiController extends AbstractController
{

    private LinesRepository $linesRepository;

    private EntityManagerInterface $entityManager;

    private DifficultyLevelRepository $difficultyLevelRepository;

    private ValidatorInterface $validator;

    public function __construct(LinesRepository $linesRepository, EntityManagerInterface $entityManager, DifficultyLevelRepository $difficultyLevelRepository, ValidatorInterface $validator)
    {
        $this->linesRepository = $linesRepository;
        $this->entityManager = $entityManager;
        $this->difficultyLevelRepository = $difficultyLevelRepository;
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

    /**
     * @Route("/lines", name="api_create_lines", methods={"POST"})
     */
    public function create(Request $request, SerializerInterface $serializer): Response
    {

        $data = $serializer->deserialize($request->getContent(), Lines::class, 'json');

        try {
            $line = new Lines();
            $difficulties = $data->getDifficulties();

            foreach ($difficulties as $difficulty)
            {
                $line->addDifficulty($this->difficultyLevelRepository->findOneBy(['name' => $difficulty->getName()]));
            }

            $this->entityManager->persist($line);
            $this->entityManager->flush();
            return $this->json('OK', 200, []);


        } catch(\Exception $e){
            $errorMessage = $e->getMessage();
            return $this->json(['message' => $errorMessage], 400, []);
        }






    }

}