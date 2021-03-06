<?php

namespace App\Controller\API;

use App\Entity\Car;
use App\Request\AddCarRequest;
use App\Request\ListCarRequest;
use App\Request\UpdateCarRequest;
use App\Service\CarService;
use App\Traits\ResponseTrait;
use App\Traits\TransferTrait;
use App\Transformer\CarTransformer;
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
        CarService $carService,
        Request $request,
        ListCarRequest $listCarRequest,
        CarValidator $carValidator,
    ): JsonResponse {
        $query = $request->query->all();
        $listCarParams = $listCarRequest->fromArray($query, $listCarRequest);
        $errors = $carValidator->validatorCarRequest($listCarParams);
        if (!empty($errors)) {
            return $this->error($errors, Response::HTTP_BAD_REQUEST);
        }
        $carList = $carService->find($listCarParams);

        return $this->success($carList, Response::HTTP_OK);
    }

    #[Route('/api/cars/{id}', name: 'app_api_car_detail', methods: 'GET')]
    public function carDetail(
        Car $car,
        CarTransformer $carTransformer,
    ): JsonResponse {
        return $this->success($carTransformer->toArray($car), Response::HTTP_OK);
    }


    #[Route('/api/cars', name: 'app_api_add_car', methods: 'POST')]
    public function addCar(
        Request $request,
        CarValidator $carValidator,
        AddCarRequest $addCarRequest,
        CarService $carService
    ): JsonResponse {
        $body = $addCarRequest->fromArray(json_decode($request->getContent(), true), $addCarRequest);
        $errors = $carValidator->validatorCarRequest($body);
        if (!empty($errors)) {
            return $this->error($errors, Response::HTTP_BAD_REQUEST);
        }
        $car = $carService->addCar($body);
        return $this->success(['message' => 'Add car success', 'car' => $this->objectToArray($car)], Response::HTTP_OK);
    }

    #[Route('/api/cars/{id}', name: 'app_api_update_car', methods: 'PUT')]
    public function updateCar(
        $id,
        Request $request,
        CarValidator $carValidator,
        UpdateCarRequest $updateCarRequest,
        CarService $carService
    ): JsonResponse {
        $body = $updateCarRequest->fromArray(json_decode($request->getContent(), true), $updateCarRequest);
        $errors = $carValidator->validatorCarRequest($body);
        if (!empty($errors)) {
            return $this->error($errors, Response::HTTP_BAD_REQUEST);
        }

        $car = $carService->updateCar($id, $body);

        return $this->success(['message' => 'Update car success', 'data' => $car], Response::HTTP_OK);
    }

    #[Route('/api/cars/{id}', name: 'app_api_update_car_patch', methods: 'PATCH')]
    public function updateCarPatch(
        $id,
        Request $request,
        CarValidator $carValidator,
        UpdateCarRequest $updateCarRequest,
        CarService $carService
    ): JsonResponse {
        $body = $updateCarRequest->fromArray(json_decode($request->getContent(), true), $updateCarRequest);
        $errors = $carValidator->validatorCarRequest($body);
        if (!empty($errors)) {
            return $this->error($errors, Response::HTTP_BAD_REQUEST);
        }
        $car = $carService->updateCarPatch($id, $body);

        return $this->success(['message' => 'Update car success', 'data' => $car], Response::HTTP_OK);
    }

    #[Route('/api/cars', name: 'app_api_delete_car', methods: 'DELETE')]
    public function deleteCar(Request $request, CarService $carService): JsonResponse
    {
        $id = json_decode($request->getContent(), true)['id'];

        $carService->deleteCar($id);
        return $this->success([], Response::HTTP_NO_CONTENT);
    }
}


