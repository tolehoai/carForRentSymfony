<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{

    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setEmail('tolehoai@gmail.com');
        $user->setPassword('$2a$12$aJek8x0otGJ6rFmqi0GO7uLaLmsmmd/9vbHeAAnErk5jvqO6QK8YW');
        $user->setRoles(['ROLE_ADMIN']);
        $manager->persist($user);

        $user1 = new User();
        $user1->setEmail('user@gmail.com');
        $user1->setPassword('$2a$12$NLnmiRobChmT3lbHMC9lLua3g9M2DexKTgAEV2/N.IiL94J4OTQyS');
        $user->setRoles(['ROLE_USER']);
        $manager->persist($user1);

        $manager->flush();
    }
}
