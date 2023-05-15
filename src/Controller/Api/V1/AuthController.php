<?php

namespace App\Controller\Api\V1;

use App\Attribute\RequestBody;
use App\Model\Request\SignUpRequest;
use App\Services\SignUpService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class AuthController extends AbstractController
{
    public function __construct(private readonly SignUpService $signUpService)
    {
    }

    #[Route('/auth/signUp', name: 'index', methods: 'POST')]
    public function signUp(#[RequestBody] SignUpRequest $request): JsonResponse
    {
        return $this->json($this->signUpService->signUp($request));
    }
}
