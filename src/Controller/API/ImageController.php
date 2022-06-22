<?php

namespace App\Controller\API;

use App\Request\ImageUploadRequest;
use App\Service\ImageService;
use App\Traits\ResponseTrait;
use App\Traits\TransferTrait;
use App\Validator\ImageValidator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ImageController extends AbstractController
{
    use ResponseTrait;
    use TransferTrait;

    #[Route('/api/image', name: 'app_api_image', methods: 'POST')]
    public function index(Request $request, ImageValidator $imageValidator, ImageUploadRequest $imageUploadRequest, ImageService $imageService): JsonResponse
    {
        $file = $request->files->get('image');
        $imageUploadRequest->setImage($file);
        $errors = $imageValidator->validatorImageRequest($imageUploadRequest);
        if (!empty($errors)) {
            return $this->error($errors);
        }
        $image = $this->objectToArray($imageService->upload($file));

        return $this->success($image);
    }
}
