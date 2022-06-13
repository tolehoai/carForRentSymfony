<?php

namespace App\Transformer;

use App\Entity\Vehicle;
use Doctrine\ORM\EntityManagerInterface;

class VehicleTransformer
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function transform(array $vehicles): array
    {
        $vehicleList = [];
        foreach ($vehicles as $index=>$value) {
            $vehicleList[$index]['id'] = $value->getId();
            $vehicleList[$index]['name'] = $value->getName();
            $vehicleList[$index]['brand'] = $value->getBrand();
            $vehicleList[$index]['color'] = $value->getColor();
            $vehicleList[$index]['img'] = $value->getImg();
            $vehicleList[$index]['luggage'] = $value->getLuggage();
            $vehicleList[$index]['doors'] = $value->getDoors();
            $vehicleList[$index]['passenger'] = $value->getPassenger();
            $vehicleList[$index]['price'] = $value->getPrice();
            $vehicleList[$index]['formatPrice'] = "$" . number_format($value->getPrice(), 0, ".", ",");
        }
        return $vehicleList;
    }
}
