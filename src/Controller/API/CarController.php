<?php

namespace App\Controller\API;

use App\Repository\CarRepository;
use App\Request\ListCarRequest;
use App\Service\CarService;
use App\Traits\TransferTrait;
use App\Validator\CarValidator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CarController extends AbstractController
{
    use TransferTrait;

    #[Route('/api/car', name: 'app_api_car')]
    public function list(
        CarService $carService,
        Request $request,
        ListCarRequest $listCarRequest,
        CarValidator $carValidator,
        CarRepository $carRepository,
    ): Response {
        $query = $request->query->all();
        $listCarParams = $listCarRequest->fromArray($query, $listCarRequest);
        $carValidator->validatorGetCarRequest($listCarParams);
        $carService->find($listCarParams, $carRepository);

        return $this->json([]);
    }


}
