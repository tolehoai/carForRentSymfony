<?php

namespace App\DataFixtures;

use App\Entity\Car;
use DateTimeImmutable;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class CarFixture extends Fixture implements DependentFixtureInterface
{

    public function load(ObjectManager $manager)
    {
        $car = new Car();
        $car->setName('Hilux');
        $car->setDescription('This is SUV car');
        $car->setColor('Black');
        $car->setBrand('Toyota');
        $car->setPrice(500);
        $car->setSeats(4);
        $car->setThumbnail($this->getReference('image'));
        $car->setCreatedUser($this->getReference('user2'));
        $car->setCreatedAt(new DateTimeImmutable(false));
        $manager->persist($car);

        $car1 = new Car();
        $car1->setName('Civic Type R');
        $car1->setDescription('This is Sedan car');
        $car1->setColor('Sliver');
        $car1->setBrand('Honda');
        $car1->setPrice(400);
        $car1->setSeats(4);
        $car1->setThumbnail($this->getReference('image2'));
        $car1->setCreatedUser($this->getReference('user3'));
        $car1->setCreatedAt(new DateTimeImmutable(false));
        $manager->persist($car1);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            ImageFixture::class,
            UserFixtures::class
        ];
    }
}
