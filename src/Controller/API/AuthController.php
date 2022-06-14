<?php

namespace App\Controller\API;

use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AuthController extends AbstractController
{
    #[Route('/api/login', name: 'app_api_login')]
    public function login(JWTTokenManagerInterface $JWTTokenManager): JsonResponse
    {
        $user = $this->getUser();
        return $this->json([
            'status'=>'success',
            'data'=>[
                'token'=> $JWTTokenManager->create($user),
            ]
        ]);
    }
}
