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
        $vehicle->setName('Hilux');
        $vehicle->setBrand('Toyota');
        $vehicle->setPrice(500);
        $vehicle->setImage(
            'https://image.thanhnien.vn/w1024/Uploaded/2022/kpqkcwvo/2022_06_02/toyota-hilux-2-7816.jpg'
        );
        $manager->persist($vehicle);

        $vehicle1 = new Vehicle();
        $vehicle1->setName('Ranger');
        $vehicle1->setBrand('Ford');
        $vehicle1->setPrice(550);
        $vehicle1->setImage('https://tinbanxe.vn/uploads/car/mceu_91935919011641608717578.jpg');
        $manager->persist($vehicle1);

        $manager->flush();
    }
}
