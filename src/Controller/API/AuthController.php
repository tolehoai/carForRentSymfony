<?php

namespace App\Controller\API;

use App\Traits\ResponseTrait;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AuthController extends AbstractController
{
    use ResponseTrait;

    #[Route('/api/login', name: 'app_api_login', methods: 'POST')]
    public function login(JWTTokenManagerInterface $JWTTokenManager): JsonResponse
    {
        $user = $this->getUser();
        $token = $JWTTokenManager->create($user);
        $data = ['token' => $token];

        return $this->success($data, Response::HTTP_OK);
    }
}

