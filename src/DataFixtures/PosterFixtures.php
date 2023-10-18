<?php

namespace App\DataFixtures;

use App\Entity\Poster;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

;

class PosterFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        for($i = 0; $i < 3; $i++) {
            for($j = 0; $j < 5; $j++){
                $poster = new Poster();
                $poster->setImageFilename("https://picsum.photos/200/300");
                $poster->setAuthor($faker->lastName);
                $poster->setAlt($faker->text(25));
                $poster->setUpdatedAt($faker->dateTime());
                $poster->setGallery($this->getReference("gallery_" . $i));
                $manager->persist($poster);
            }
        }
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
