<?php

namespace App\Controller;

use App\Data\StudentDto;
use App\Entity\Student;
use App\Exception\ValidationException;
use App\Repository\StudentRepository;
use App\Services\StudentService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

#[Route('/api/v1/students', name: 'students_')]
class StudentController extends AbstractController
{
    public function __construct(private readonly StudentRepository $repository)
    {
    }

    #[Route('/', name: 'index', methods: ['GET'])]
    public function index(): JsonResponse
    {
        return $this->json(StudentDto::collection($this->repository->paginate()));
    }

    #[Route('/{id}', name: 'show', methods: ['GET'])]
    public function show(Student $student): JsonResponse
    {
        return $this->json([
            'message' => 'Student fetched successfully',
            'data'    => StudentDto::fromModel($student),
        ]);
    }

    /**
     * @throws ValidationException
     */
    #[Route('/create', name: 'store', methods: ['POST'])]
    public function store(
        ValidatorInterface $validator,
        Request $request,
        SerializerInterface $serializer,
        StudentService $service,
    ): JsonResponse {
        /** @var StudentDto $studentDto */
        $studentDto = $serializer->deserialize($request->getContent(), StudentDto::class, 'json');

        $errors = $validator->validate($studentDto);

        if (count($errors) > 0) {
            throw new ValidationException($errors);
        }

        $student = $service->create($studentDto);

        return $this->json(['message' => 'Saved new student with id '.$student->getId()]);
    }
}
