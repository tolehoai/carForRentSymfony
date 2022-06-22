<?php

namespace App\Service;

use App\Entity\Car;
use App\Maping\AddCarRequestToCar;
use App\Maping\UpdateCarRequestToCar;
use App\Maping\UpdateCarRequestToCarPatch;
use App\Repository\CarRepository;
use App\Request\AddCarRequest;
use App\Request\ListCarRequest;
use App\Request\UpdateCarRequest;
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
    private UpdateCarRequestToCar $updateCarRequestToCar;

    public function __construct(
        CarTransformer $carTransformer,
        CarRepository $carRepository,
        AddCarRequestToCar $addCarRequestToCar,
        UpdateCarRequestToCar $updateCarRequestToCar,
    ) {
        $this->carTransformer = $carTransformer;
        $this->carRepository = $carRepository;
        $this->addCarRequestToCar = $addCarRequestToCar;
        $this->updateCarRequestToCar = $updateCarRequestToCar;
    }

    public function addCar(
        AddCarRequest $addCarRequest,
    ) {
        $car = $this->addCarRequestToCar->mapping($addCarRequest);
        $this->carRepository->add($car, true);
        return $car;
    }

    public function deleteCar(
        string $id
    ) {
        $car = $this->carRepository->find($id);
        $this->carRepository->remove($car, true);
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

    public function updateCar(
        string $id,
        UpdateCarRequest $updateCarRequest
    ) {
        $car = $this->carRepository->find($id);
        $carMapper = $this->updateCarRequestToCar->mapping($car, $updateCarRequest);
        $this->carRepository->add($carMapper, true);
        return $this->carTransformer->toArray($carMapper);
    }

    public function updateCarPatch(
        string $id,
        UpdateCarRequest $updateCarRequest
    ) {
        $car = $this->carRepository->find($id);
        $carMapper = $this->updateCarRequestToCar->mappingWithNull($car, $updateCarRequest);
        $this->carRepository->add($carMapper, true);
        return $this->carTransformer->toArray($carMapper);
    }
}

