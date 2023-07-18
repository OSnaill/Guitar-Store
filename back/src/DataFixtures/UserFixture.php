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

        // * ------ Configurez votre email ici
        $user->setEmail("test@example.com");
        $passwordHasher = $this->passwordHasherInterface->getPasswordHasher(User::class);

        // * ------ Configurez votre mot de passe ici
        $hash = $passwordHasher->hash("password");

        $user->setPassword($hash);
        $manager->persist($user);
        $manager->flush();
        
    }
}
