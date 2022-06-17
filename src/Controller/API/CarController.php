<?php

namespace App\Controller\API;

use App\Request\ListCarRequest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class CarController extends AbstractController
{

    #[Route('/api/car', name: 'app_api_car')]
    public function list(Request $request, ListCarRequest $listCarRequest,ValidatorInterface $validator ): Response
    {
        $query = $request->query->all();

        $listCarParams = $listCarRequest->fromArray($query);
        dd($listCarParams);

        $errors = $validator->validate($listCarParams);
        return $this->json([]);
    }


}
