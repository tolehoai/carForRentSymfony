<?php

namespace App\Traits;

use Symfony\Component\HttpFoundation\JsonResponse;

trait ResponseTrait
{
    public function success(string $token): JsonResponse
    {
        $jsonResponse = new JsonResponse();
        return $jsonResponse->setData([
            'status' => 'success',
            'data' => [
                'token' => $token
            ]
        ]);
    }

    public function error() :JsonResponse
    {
        $jsonResponse = new JsonResponse();
        return $jsonResponse->setData([
            'status' => 'error',
            'message' => 'Credentials invalid'
        ]);
    }

}
