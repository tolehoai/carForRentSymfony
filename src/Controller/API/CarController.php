<?php

namespace App\Controller\API;

use App\Request\ListCarRequest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CarController extends AbstractController
{

    #[Route('/api/car', name: 'app_api_car')]
    public function list(Request $request, ListCarRequest $listCarRequest, ): Response
    {
        $query = $request->query->all();
        $listCarRequest->fromArray($query);
        dd($listCarRequest);
        return $this->json([]);
    }


}
