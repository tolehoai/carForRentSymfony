<?php

namespace App\Service;

use App\Form\VehicleTransformer;
use App\Repository\VehicleRepository;

class VehicleService
{
    private VehicleRepository $vehicleRepository;
    private VehicleTransformer $vehicleTransformer;

    public function __construct(VehicleRepository $vehicleRepository, VehicleTransformer $vehicleTransformer)
    {
        $this->vehicleRepository = $vehicleRepository;
        $this->vehicleTransformer = $vehicleTransformer;
    }

    public function getAllCar(): array
    {
        $vehicleList = [];
        $vehicles = $this->vehicleRepository->findAll();
        foreach ($vehicles as $vehicle) {
            $vehicleTransformer = $this->vehicleTransformer->transform($vehicle);
            $vehicleList[] = $vehicleTransformer;
        }
        return $vehicleList;
    }
}
