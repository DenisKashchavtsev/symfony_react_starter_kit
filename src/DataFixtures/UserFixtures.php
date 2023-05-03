<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    public function __construct(private UserPasswordHasherInterface $hasher)
    {
    }

    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setFirstName('Firstname');
        $user->setLastName('Lastname');
        $user->setEmail('demo@demo.com');
        $user->setPassword($this->hasher->hashPassword($user, 'demo1234'));

        $user->setRoles(['ROLE_USER']);

        $manager->persist($user);
        $manager->flush();
    }
}
