<?php

namespace App\Service;

use App\Entity\Car;
use App\Repository\CarRepository;
use App\Request\ListCarRequest;
use App\Traits\TransferTrait;
use App\Transformer\CarTransformer;
use App\Validator\CarValidator;
use Symfony\Component\HttpFoundation\Request;

class CarService
{
    use TransferTrait;
    private CarTransformer $carTransformer;
    public function __construct(CarTransformer $carTransformer)
    {
        $this->carTransformer =$carTransformer;
    }

    public function find(
        ListCarRequest $listCarRequest,
        CarRepository $carRepository,
    ) {
        $params = $this->objectToArray($listCarRequest);
        $car = new Car();
        $listCarParamsArray = $listCarRequest->transfer($params, $listCarRequest, $car);
        $cars =$carRepository->filter($listCarParamsArray);

        return $this->carTransformer->toArrayList($cars);
    }
}