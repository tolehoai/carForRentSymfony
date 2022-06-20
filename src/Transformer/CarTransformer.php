<?php

namespace App\Transformer;

use App\Entity\Car;

class CarTransformer extends AbstractTransformer

{
    const ATTRIBUTE = ['name', 'brand', 'color', 'price', 'seats'];

    public function toArrayList(array $cars): array
    {
        $carList = [];
        foreach ($cars as $car) {
            $carList[] = $this->toArray($car);
        }

        return $carList;
    }

    public function toArray(Car $car): array
    {
        $result = $this->transform($car, self::ATTRIBUTE);
        $result['thumbnail'] = $car->getThumbnail()->getPath();
        $result['createdUser'] = $car->getCreatedUser()->getEmail();

        return $result;
    }
}
