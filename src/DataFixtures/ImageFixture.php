<?php

namespace App\DataFixtures;

use App\Entity\Image;
use DateTimeImmutable;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ImageFixture extends Fixture
{

    public function load(ObjectManager $manager)
    {
        $image = new Image();
        $image->setPath('https://muabanxeford.com.vn/wp-content/uploads/2021/07/toyota-hilux-2022-moi-mau-ba.jpg');
        $image->setCreatedAt(new DateTimeImmutable(false));
        $manager->persist($image);

        $image2 = new Image();
        $image2->setPath(
            'https://static1.cafeauto.vn/cafeautoData/upload/tintuc/thitruong/2019/07/tuan-01/h1-1562160878.jpg'
        );
        $image2->setCreatedAt(new DateTimeImmutable(false));
        $manager->persist($image2);

        $manager->flush();

        $this->addReference('image', $image);
        $this->addReference('image2', $image2);
    }
}
