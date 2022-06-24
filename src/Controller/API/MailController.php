<?php

namespace App\Controller\API;

use App\Service\MailService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class MailController extends AbstractController
{
    #[Route('/api/mail', name: 'app_api_mail')]
    public function send(MailService $mailService): JsonResponse
    {
        $mailService->sendMail();
        return $this->json([
            'message' => 'Admin homepage'
        ], 200);
    }
}