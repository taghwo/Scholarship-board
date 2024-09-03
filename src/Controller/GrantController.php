<?php

namespace App\Controller;

use App\Repository\ScholarshipRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/grants', name: 'grants_')]
class GrantController extends AbstractController
{
    public function __construct(private readonly ScholarshipRepository $repository)
    {
    }

    #[Route('/', name: 'index')]
    public function index(): Response
    {
        return $this->json($this->repository->paginate());
    }
}
