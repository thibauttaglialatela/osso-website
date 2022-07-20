<?php

namespace App\DataFixtures;

use App\Entity\Gallery;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class GalleryFixtures extends Fixture
{
    public const GALLERY_NB = 3;

    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $faker = Factory::create('fr_FR');

        for ($i = 0; $i < self::GALLERY_NB; ++$i) {
            $gallery = new Gallery();
            $gallery->setTitle($faker->sentence());
            $gallery->setDate($faker->dateTimeBetween('-1 year', 'now'));
            $manager->persist($gallery);

            $this->addReference('gallery_'.$i, $gallery);
        }

        $manager->flush();
    }
}
