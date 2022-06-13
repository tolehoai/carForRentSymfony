<?php

namespace App\Controller;

use App\Repository\VehicleRepository;
use App\Transformer\VehicleTransformer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VehicleController extends AbstractController
{
    #[Route('/vehicle', name: 'app_vehicle')]
    public function index(VehicleRepository $vehicleRepository, VehicleTransformer $vehicleTransformer): Response
    {
        $vehicle = $vehicleRepository->findAll();
        return $this->render('vehicles/index.html.twig',[
            'vehicles' => $vehicleTransformer->transform($vehicle),
        ]);
    }
}
