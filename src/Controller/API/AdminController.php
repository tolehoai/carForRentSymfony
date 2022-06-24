<?php

namespace App\Controller\API;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    #[Route('/api/admin', name: 'app_api_admin')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Admin homepage'
        ], 200);
    }
}

