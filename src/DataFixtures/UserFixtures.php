<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    private UserPasswordHasherInterface $userPasswordHasher;

    public function __construct(UserPasswordHasherInterface $userPasswordHasher)
    {
        $this->userPasswordHasher = $userPasswordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $email = 'orchestreosso@gmail.com';
        $plainPassword = 'OssoPa$$word';
        $roles[] = 'ROLE_ADMIN';
        $user->setEmail($email);
        $user->setPassword($this->userPasswordHasher->hashPassword(
            $user, $plainPassword
        ));
        $user->setRoles($roles);
        $manager->persist($user);
        $manager->flush();
    }
}
