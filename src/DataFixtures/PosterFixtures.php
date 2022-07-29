<?php

namespace App\DataFixtures;

use App\Entity\Poster;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class PosterFixtures extends Fixture implements DependentFixtureInterface
{
    public const PICTURE_NB = 5;

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        for ($i = 0; $i < self::PICTURE_NB; ++$i) {
            $poster = new Poster();
            $poster->setImage('https://picsum.photos/200');
            $poster->setAlt($faker->sentence(3));
            $poster->setUpdatedAt($faker->dateTimeBetween('-1 year'));
            $poster->setAuthor($faker->name);
            $poster->setGallery($this->getReference('gallery_0'));
            $manager->persist($poster);
        }

        for ($i = 0; $i < self::PICTURE_NB; ++$i) {
            $poster = new Poster();
            $poster->setImage('https://picsum.photos/200');
            $poster->setAlt($faker->sentence(3));
            $poster->setUpdatedAt($faker->dateTimeBetween('-1 year'));
            $poster->setAuthor($faker->name);
            $poster->setGallery($this->getReference('gallery_1'));
            $manager->persist($poster);
        }

        for ($i = 0; $i < self::PICTURE_NB; ++$i) {
            $poster = new Poster();
            $poster->setImage('https://picsum.photos/200');
            $poster->setAlt($faker->sentence(3));
            $poster->setUpdatedAt($faker->dateTimeBetween('-1 year'));
            $poster->setAuthor($faker->name);
            $poster->setGallery($this->getReference('gallery_2'));
            $manager->persist($poster);
        }

        $manager->flush();
    }

    /**
     * @return string[]
     */
    public function getDependencies(): array
    {
        return [
            GalleryFixtures::class,
        ];
    }
}
