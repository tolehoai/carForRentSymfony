<?php

namespace App\Service;

use App\Entity\Car;
use App\Maping\AddCarRequestToCar;
use App\Repository\CarRepository;
use App\Request\AddCarRequest;
use App\Request\ListCarRequest;
use App\Traits\ResponseTrait;
use App\Traits\TransferTrait;
use App\Transformer\CarTransformer;

class CarService
{
    use TransferTrait;
    use ResponseTrait;

    private CarTransformer $carTransformer;
    private CarRepository $carRepository;
    private AddCarRequestToCar $addCarRequestToCar;

    public function __construct(
        CarTransformer $carTransformer,
        CarRepository $carRepository,
        AddCarRequestToCar $addCarRequestToCar
    ) {
        $this->carTransformer = $carTransformer;
        $this->carRepository = $carRepository;
        $this->addCarRequestToCar = $addCarRequestToCar;
    }

    public function addCar(
        AddCarRequest $addCarRequest,
    ) {
        $car = $this->addCarRequestToCar->mapping($addCarRequest);
        $this->carRepository->add($car, true);
        return $this->success(['message'=>'Add car success']);
    }

    public function deleteCar(
        string $id
    ) {
        $car = $this->carRepository->find($id);
        $this->carRepository->remove($car, true);
        return $this->success(['message'=>'Delete car success']);
    }

    public function find(
        ListCarRequest $listCarRequest,
    ) {
        $params = $this->objectToArray($listCarRequest);
        $car = new Car();
        $listCarParamsArray = $listCarRequest->transfer($params, $listCarRequest, $car);
        $cars = $this->carRepository->filter($listCarParamsArray);

        return $this->carTransformer->toArrayList($cars);
    }
}