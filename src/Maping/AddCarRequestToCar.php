<?php

namespace App\Maping;

use App\Entity\AbstractEntity;
use App\Entity\Car;
use App\Repository\ImageRepository;
use App\Repository\UserRepository;
use App\Request\AddCarRequest;

class AddCarRequestToCar
{
    private UserRepository $userRepository;
    private ImageRepository $imageRepository;

    public function __construct(UserRepository $userRepository, ImageRepository $imageRepository)
    {
        $this->userRepository = $userRepository;
        $this->imageRepository = $imageRepository;
    }

    public function mapping(AddCarRequest $addCarRequest): AbstractEntity
    {
        $user = $this->userRepository->find($addCarRequest->getCreatedUser());
        $car = new Car();
        $car->setCreatedUser($user);
        $image = $this->imageRepository->find($addCarRequest->getThumbnail());
        $car->setThumbnail($image);
        $car->setName($addCarRequest->getName());
        $car->setDescription($addCarRequest->getDescription());
        $car->setColor($addCarRequest->getColor());
        $car->setBrand($addCarRequest->getBrand());
        $car->setPrice($addCarRequest->getPrice());
        $car->setSeats($addCarRequest->getSeats());
        $car->setYear($addCarRequest->getYear());
        $car->setCreatedAt(new \DateTimeImmutable());

        return $car;
    }
}