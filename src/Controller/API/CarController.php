<?php

namespace App\Controller\API;

use App\Request\ListCarRequest;
use App\Validator\CarValidator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Traits\TransferTrait;

class CarController extends AbstractController
{
    use TransferTrait;
    #[Route('/api/car', name: 'app_api_car')]
    public function list(
        Request        $request,
        ListCarRequest $listCarRequest,
        CarValidator   $carValidator,
    ): Response
    {
        $query = $request->query->all();
        $listCarParams = $listCarRequest->fromArray($query);
        $carValidator->validatorGetCarRequest($listCarParams);
        $params = ['order', 'color', 'brand', 'seats'];
        dump($listCarParams);
        dump($this->objectToArray($listCarParams));

        return $this->json([]);
    }


}
