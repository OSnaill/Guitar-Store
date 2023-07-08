<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\PasswordHasherFactory;
use Symfony\Component\PasswordHasher\Hasher\PasswordHasherFactoryInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixture extends Fixture
{
    private $passwordHasherInterface;

    public function __construct (PasswordHasherFactoryInterface $passwordHasherInterface)
    {
        $this->passwordHasherInterface = $passwordHasherInterface;
    }
    public function load(ObjectManager $manager) : void
    {
        $user = new User();
        $user->setEmail("test@example.com");
        //$user->setPassword("test_pass");
        $passwordHasher = $this->passwordHasherInterface->getPasswordHasher(User::class);
        $hash = $passwordHasher->hash("password");

        $user->setPassword($hash);
        $manager->persist($user);
        $manager->flush();
        
    }
}
