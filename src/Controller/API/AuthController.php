<?php

namespace App\Controller\API;

use App\EventListener\ExceptionEvent;
use App\Traits\ResponseTrait;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Finder\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;

class AuthController extends AbstractController
{
    use ResponseTrait;

    private $dispatcher;

    public function __construct(EventDispatcherInterface $dispatcher)
    {
    }

    #[Route('/api/login', name: 'app_api_login')]
    public function login(JWTTokenManagerInterface $JWTTokenManager): JsonResponse
    {
        $user = $this->getUser();

        $token = $JWTTokenManager->create($user);
        return $this->success($token);
    }
}
