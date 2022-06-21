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
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CarController extends AbstractController
{
    use TransferTrait;
    use ResponseTrait;

    #[Route('/api/car', name: 'app_api_car', methods: 'GET')]
    public function list(
        CarService $carService,
        Request $request,
        ListCarRequest $listCarRequest,
        CarValidator $carValidator,
    ): Response {
        $query = $request->query->all();
        $listCarParams = $listCarRequest->fromArray($query, $listCarRequest);
        $carValidator->validatorCarRequest($listCarParams);
        $carList = $carService->find($listCarParams);

        return $this->success($carList);
    }

    #[Route('/api/car', name: 'app_api_delete_car', methods: 'DELETE')]
    public function deleteCar(Request $request, AddCarRequest $addCarRequest, CarService $carService): Response
    {
        $id = json_decode($request->getContent(), true)['id'];

        return $carService->deleteCar($id);
    }

    #[Route('/api/car', name: 'app_api_add_car', methods: 'POST')]
    public function addCar(Request $request, AddCarRequest $addCarRequest, CarService $carService): Response
    {
        $body = $addCarRequest->fromArray(json_decode($request->getContent(), true), $addCarRequest);

        return $carService->addCar($body);
    }

    #[Route('/api/car/{id}', name: 'app_api_update_car', methods: 'PUT')]
    public function updateCar(
        $id,
        Request $request,
        UpdateCarRequest $updateCarRequest,
        CarService $carService
    ): Response {
        $body = $updateCarRequest->fromArray(json_decode($request->getContent(), true), $updateCarRequest);

        return $carService->updateCar($id, $body);
    }

    #[Route('/api/car/{id}', name: 'app_api_update_car_patch', methods: 'PATCH')]
    public function updateCarPatch(
        $id,
        Request $request,
        UpdateCarRequest $updateCarRequest,
        CarService $carService
    ): Response {
        $body = $updateCarRequest->fromArray(json_decode($request->getContent(), true), $updateCarRequest);

        return $carService->updateCarPatch($id, $body);
    }
}


