<?php

namespace App\Controller\API;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class ProfileController extends AbstractController
{
    #[Route('/api/profile', name: 'app_api_profile')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Profile homepage'
        ], 200);
    }
}
