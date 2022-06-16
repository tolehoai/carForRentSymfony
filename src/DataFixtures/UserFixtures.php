<?php

namespace App\DataFixtures;

use App\Entity\User;
use DateTimeImmutable;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{

    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setEmail('tolehoai@gmail.com');
        $user->setName('tolehoai');
        $user->setPassword('$2a$12$aJek8x0otGJ6rFmqi0GO7uLaLmsmmd/9vbHeAAnErk5jvqO6QK8YW');
        $user->setRoles(['ROLE_ADMIN']);
        $user->setCreatedAt(new DateTimeImmutable(false));
        $manager->persist($user);

        $user2 = new User();
        $user2->setEmail('user@gmail.com');
        $user2->setName('user');
        $user2->setPassword('$2a$12$NLnmiRobChmT3lbHMC9lLua3g9M2DexKTgAEV2/N.IiL94J4OTQyS');
        $user2->setRoles(['ROLE_USER']);
        $user2->setCreatedAt(new DateTimeImmutable(false));
        $manager->persist($user2);

        $user3 = new User();
        $user3->setEmail('user2@gmail.com');
        $user3->setName('user2');
        $user3->setPassword('$2a$12$NLnmiRobChmT3lbHMC9lLua3g9M2DexKTgAEV2/N.IiL94J4OTQyS');
        $user3->setRoles(['ROLE_USER']);
        $user3->setCreatedAt(new DateTimeImmutable(false));
        $manager->persist($user3);

        $manager->flush();

        $this->addReference('user', $user);
        $this->addReference('user2', $user2);
        $this->addReference('user3', $user3);
    }
}
