<?php

namespace App\Controller\API;

use App\Repository\CarRepository;
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
        CarRepository  $carRepository
    ): Response
    {
        $query = $request->query->all();
        $listCarParams = $listCarRequest->fromArray($query);
        $carValidator->validatorGetCarRequest($listCarParams);
        $params = $this->objectToArray($listCarParams);
        $listCarParamsArray = $listCarRequest->transfer($params, $listCarRequest);
        $filterCar = $carRepository->filter($listCarParamsArray);
        dd($filterCar);
        return $this->json([]);
    }


}
