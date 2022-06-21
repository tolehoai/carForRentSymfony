<?php

namespace App\Traits;

use Symfony\Component\HttpFoundation\JsonResponse;

trait ResponseTrait
{
    public function success(array $data): JsonResponse
    {
        $jsonResponse = new JsonResponse();
        
        return $jsonResponse->setData([
            'status' => 'success',
            'data' => $data
        ]);
    }

    public function error(array $data): JsonResponse
    {
        $jsonResponse = new JsonResponse();

        return $jsonResponse->setData([
            'status' => 'error',
            'errors' => $data
        ]);
    }
}

