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
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;


/**
 * @Route("/api", name="api")
 * @IsGranted("ROLE_USER")
 */
class LinesApiController extends AbstractController
{

    private LinesRepository $linesRepository;

    private EntityManagerInterface $entityManager;

    private DifficultyLevelRepository $difficultyLevelRepository;

    private ValidatorInterface $validator;

    public function __construct(LinesRepository $linesRepository, EntityManagerInterface $entityManager, DifficultyLevelRepository $difficultyLevelRepository)
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
    public function create(Request $request, SerializerInterface $serializer, ValidatorInterface $validator): Response
    {

        $data = $serializer->deserialize($request->getContent(), Lines::class, 'json');

        $line = new Lines();
        $difficulties = $data->getDifficulties();

        foreach ($difficulties as $difficulty) {
            $line->addDifficulty($this->difficultyLevelRepository->findOneBy(['name' => $difficulty->getName()]));
        }

        $errors = $validator->validate($line);

        if (count($errors) > 0) {

            $errorsString = (string) $errors;

            return $this->json(['message' => $errorsString], 400, []);

        } else {
            $this->entityManager->persist($line);
            $this->entityManager->flush();
            return $this->json(['message' => 'OK'], 200, []);

        }
    }

    /**
     * @Route("/lines/{id}", name="api_update_line", methods={"PUT"})
     */
    public function update(Lines $line, Request $request, SerializerInterface $serializer, ValidatorInterface  $validator): Response
    {
        $data = $serializer->deserialize($request->getContent(), Lines::class, 'json');
        $name = $data->getName();
        $difficulties = $data->getDifficulties();
        $line->setName($name);

        foreach ($difficulties as $difficulty) {
            $difficulty_level = $this->difficultyLevelRepository->findOneBy(['name' => $difficulty->getName()]);
            if (!$difficulty_level) {
                return $this->json(['message' => 'This difficulty ('.$difficulty->getName().') does not exists'], 404, []);
            }
            $line->addDifficulty($difficulty_level);
        }

        $errors = $validator->validate($line);

        if (count($errors) > 0) {
            $errorsString = (string) $errors;

            return $this->json(['message' => $errorsString], 400, []);
        } else {
            $this->entityManager->persist($line);
            $this->entityManager->flush();

            return $this->json(['message' => "OK"], 200, []);
        }
    }

}