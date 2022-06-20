<?php

namespace App\Maping;

use App\Entity\AbstractEntity;
use App\Entity\Car;
use App\Repository\ImageRepository;
use App\Repository\UserRepository;
use App\Request\UpdateCarRequest;

class UpdateCarRequestToCar
{
    private UserRepository $userRepository;
    private ImageRepository $imageRepository;

    public function __construct(UserRepository $userRepository, ImageRepository $imageRepository)
    {
        $this->userRepository = $userRepository;
        $this->imageRepository = $imageRepository;
    }

    public function mapping(Car $car, UpdateCarRequest $updateCarRequest): AbstractEntity
    {
        $user = $this->userRepository->find($updateCarRequest->getCreatedUser());
        $car->setCreatedUser($user);
        $image = $this->imageRepository->find($updateCarRequest->getThumbnail());
        $car->setThumbnail($image);

        $car->setName($updateCarRequest->getName());
        $car->setDescription($updateCarRequest->getDescription());
        $car->setColor($updateCarRequest->getColor());
        $car->setBrand($updateCarRequest->getBrand());
        $car->setPrice($updateCarRequest->getPrice());
        $car->setSeats($updateCarRequest->getSeats());
        $car->setYear($updateCarRequest->getYear());
        $car->setCreatedAt(new \DateTimeImmutable());

        return $car;
    }

    public function mappingWithNull(Car $car, UpdateCarRequest $updateCarRequest): AbstractEntity
    {

        $user = $this->userRepository->find($car->getCreatedUser());
        $car->setCreatedUser($user);

        if ($updateCarRequest->getThumbnail()) {
            $image = $this->imageRepository->find($updateCarRequest->getThumbnail());
            $car->setThumbnail($image);
        }
        if ($updateCarRequest->getName()) {
            $car->setName($updateCarRequest->getName());
        }
        if ($updateCarRequest->getDescription()) {
            $car->setDescription($updateCarRequest->getDescription());
        }
        if ($updateCarRequest->getColor()) {
            $car->setColor($updateCarRequest->getColor());
        }
        if($updateCarRequest->getBrand()){
            $car->setBrand($updateCarRequest->getBrand());
        }
        if($updateCarRequest->getPrice()){
            $car->setPrice($updateCarRequest->getPrice());
        }
        if($updateCarRequest->getSeats()){
            $car->setSeats($updateCarRequest->getSeats());
        }
        if($updateCarRequest->getYear()){
            $car->setYear($updateCarRequest->getYear());
        }
        $car->setCreatedAt(new \DateTimeImmutable());

        return $car;
    }
}