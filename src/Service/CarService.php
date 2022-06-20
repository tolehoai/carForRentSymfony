<?php

namespace App\Service;

use App\Entity\Car;
use App\Repository\CarRepository;
use App\Request\ListCarRequest;
use App\Traits\TransferTrait;
use App\Validator\CarValidator;
use Symfony\Component\HttpFoundation\Request;

class CarService
{
    use TransferTrait;
    public function find(
        ListCarRequest $listCarRequest,
        CarRepository $carRepository,
    ) {
        $params = $this->objectToArray($listCarRequest);
        $car = new Car();
        $listCarParamsArray = $listCarRequest->transfer($params, $listCarRequest, $car);
        $filterCar = $carRepository->filter($listCarParamsArray);
        dd($filterCar);
    }
}