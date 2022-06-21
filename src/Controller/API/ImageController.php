<?php

namespace App\Controller\API;

use App\Service\ImageService;
use App\Traits\ResponseTrait;
use App\Traits\TransferTrait;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ImageController extends AbstractController
{
    use ResponseTrait;
    use TransferTrait;

    #[Route('/api/image', name: 'app_api_image', methods: 'POST')]
    public function index(Request $request, ImageService $imageService): JsonResponse
    {
        $file = $request->files->get('image');
       $image = $this->objectToArray($imageService->upload($file));

        return $this->success($image);

    }
}