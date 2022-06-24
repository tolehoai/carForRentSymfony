<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    #[Route('/user', name: 'app_user')]
    public function index(UserRepository $userRepository): Response
    {
        $user = new User();
        $user->setEmail('admin1@gmail.com');
        $user->setPassword('$2a$12$EuUvhPhzh8.950pI/80/FOvYOsJKUgQlXTCtLQV.xIGEoKjy3kHZu');
        $user->setRoles(['{"role": "ROLE_ADMIN"}']);
        $userRepository->add($user, true);

        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }
}

