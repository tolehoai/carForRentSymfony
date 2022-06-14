<?php

namespace App\Controller\API;

use App\Event\DemoEvent;
use App\EventListener\DemoListener;
use App\Subscriber\StoreSubscriber;
use App\Traits\ResponseTrait;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\Finder\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class AuthController extends AbstractController
{
    use ResponseTrait;

    #[Route('/api/login', name: 'app_api_login')]
    public function login(JWTTokenManagerInterface $JWTTokenManager): JsonResponse
    {
        $dispatcher = new EventDispatcher();
        $subscriber = new StoreSubscriber();
        $dispatcher->addSubscriber($subscriber);
        $dispatcher->dispatch('foo.action');

        dd(99);

        $user = $this->getUser();
        if ($user == null) {

            throw new AccessDeniedException('Access Denied');
//            return $this->error();
        }
        $token = $JWTTokenManager->create($user);
        return $this->success($token);
    }
}
