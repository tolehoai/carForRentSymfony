<?php

namespace App\Controller\API;

use App\Request\AddCarRequest;
use App\Request\ListCarRequest;
use App\Request\UpdateCarRequest;
use App\Service\CarService;
use App\Traits\ResponseTrait;
use App\Traits\TransferTrait;
use App\Validator\CarValidator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CarController extends AbstractController
{
    use TransferTrait;
    use ResponseTrait;

    #[Route('/api/cars', name: 'app_api_car', methods: 'GET')]
    public function list(
        CarService     $carService,
        Request        $request,
        ListCarRequest $listCarRequest,
        CarValidator   $carValidator,
    ): JsonResponse
    {
        $query = $request->query->all();
        $listCarParams = $listCarRequest->fromArray($query, $listCarRequest);
        $errors = $carValidator->validatorCarRequest($listCarParams);
        if (!empty($errors)) {
            return $this->error($errors);
        }
        $carList = $carService->find($listCarParams);

        return $this->success($carList);
    }

    #[Route('/api/cars', name: 'app_api_delete_car', methods: 'DELETE')]
    public function deleteCar(Request $request, AddCarRequest $addCarRequest, CarService $carService): JsonResponse
    {
        $id = json_decode($request->getContent(), true)['id'];

        $carService->deleteCar($id);
        return $this->success(['message' => 'Delete car success']);

    }

    #[Route('/api/cars', name: 'app_api_add_car', methods: 'POST')]
    public function addCar(Request $request, AddCarRequest $addCarRequest, CarService $carService): JsonResponse
    {
        $body = $addCarRequest->fromArray(json_decode($request->getContent(), true), $addCarRequest);
        $car = $carService->addCar($body);

        return $this->success(['message' => 'Add car success', 'data' => $car]);
    }

    #[Route('/api/cars/{id}', name: 'app_api_update_car', methods: 'PUT')]
    public function updateCar(
        $id,
        Request $request,
        UpdateCarRequest $updateCarRequest,
        CarService $carService
    ): JsonResponse
    {
        $body = $updateCarRequest->fromArray(json_decode($request->getContent(), true), $updateCarRequest);
        $car = $carService->updateCar($id, $body);

        return $this->success(['message' => 'Update car success', 'data' => $car]);
    }

    #[Route('/api/cars/{id}', name: 'app_api_update_car_patch', methods: 'PATCH')]
    public function updateCarPatch(
        $id,
        Request $request,
        UpdateCarRequest $updateCarRequest,
        CarService $carService
    ): JsonResponse
    {
        $body = $updateCarRequest->fromArray(json_decode($request->getContent(), true), $updateCarRequest);
        $car = $carService->updateCarPatch($id, $body);

        return $this->success(['message' => 'Update car success', 'data' => $car]);
    }
}


