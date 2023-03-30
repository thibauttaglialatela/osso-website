<?php

namespace App\DataFixtures;

use App\Entity\Contenu;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ContenuFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        $orchestraHistory = new Contenu();
        $orchestraHistory->setIdentifier('orchestra-presentation');
        $orchestraHistory->setTitle("A propos de l'Orchestre Symphonique du Sud-Ouest");
        $orchestraHistory->setBody($faker->realTextBetween());
        $manager->persist($orchestraHistory);

        $directorBiography = new Contenu();
        $directorBiography->setIdentifier('orchestra-presentation');
        $directorBiography->setTitle('Biographie d\'Alain Perpétue');
        $directorBiography->setBody($faker->realTextBetween());
        $manager->persist($directorBiography);

        $administrationMembers = new Contenu();
        $administrationMembers->setIdentifier('orchestra-presentation');
        $administrationMembers->setTitle('Membres du conseil d\'administration et du bureau');
        $administrationMembers->setBody($faker->realTextBetween());
        $manager->persist($administrationMembers);

        $manager->flush();
    }
}
