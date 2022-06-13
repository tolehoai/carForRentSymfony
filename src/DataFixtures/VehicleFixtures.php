<?php

namespace App\DataFixtures;

use App\Entity\Vehicle;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class VehicleFixtures extends Fixture
{

    public function load(ObjectManager $manager)
    {
        $vehicle = new Vehicle();
        $vehicle->setName('Civic');
        $vehicle->setBrand('Honda');
        $vehicle->setColor('Black');
        $vehicle->setImg('https://i1-vnexpress.vnecdn.net/2022/02/20/1702HondaCivicVnE1491jpg-1645347953.jpg?w=750&h=450&q=100&dpr=1&fit=crop&s=q0KxK4NtTpu7C00KhxCRoQ');
        $vehicle->setLuggage(2);
        $vehicle->setDoors(4);
        $vehicle->setPassenger(4);
        $vehicle->setPrice(400);
        $manager->persist($vehicle);

        $vehicle1 = new Vehicle();
        $vehicle1->setName('Explorer');
        $vehicle1->setBrand('Ford');
        $vehicle1->setColor('White');
        $vehicle1->setImg('https://img1.oto.com.vn/2022/01/11/1OANJGk2/03-ford-explorer-ngoai-that-45ed.jpg');
        $vehicle1->setLuggage(2);
        $vehicle1->setDoors(4);
        $vehicle1->setPassenger(4);
        $vehicle1->setPrice(700);
        $manager->persist($vehicle1);

        $manager->flush();
    }
}