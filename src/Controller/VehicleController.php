<?php

namespace App\Controller;

use App\Entity\Vehicle;
use App\Service\VehicleService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VehicleController extends AbstractController
{
    #[Route('/vehicle/', name: 'app_index_vehicle')]
    public function index(VehicleService $vehicleService): Response
    {
        $vehicles = $vehicleService->getAllCar();
        return $this->render('vehicle/index.html.twig', [
            'vehicles' => $vehicles
        ]);
    }

    #[Route('/vehicle/{id}', name: 'app_detail_vehicle')]
    public function show(Vehicle $vehicle): Response
    {
        return $this->render('vehicle/detail.html.twig', [
            'controller_name' => 'VehicleController',
            'vehicle' => $vehicle
        ]);
    }
}

