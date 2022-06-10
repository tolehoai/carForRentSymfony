<?php

namespace App\Form;

use App\Entity\Vehicle;
use Doctrine\ORM\EntityManagerInterface;

class VehicleTransformer
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function transform(Vehicle $vehicle): array
    {
        return [
            'id' => $vehicle->getId(),
            'name' => $vehicle->getName(),
            'brand' => $vehicle->getBrand(),
            'color' => $vehicle->getColor(),
            'img' => $vehicle->getImg(),
            'luggage' => $vehicle->getLuggage(),
            'doors' => $vehicle->getDoors(),
            'passenger' => $vehicle->getPassenger(),
            'price' => $vehicle->getPrice(),
            'formatPrice' => "$" . number_format($vehicle->getPrice(), 0, ".", ",")
        ];
    }
}
