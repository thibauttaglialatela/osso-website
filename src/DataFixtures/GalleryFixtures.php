<?php

namespace App\DataFixtures;

use App\Entity\Gallery;
use App\Service\Slugify;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class GalleryFixtures extends Fixture
{
    public const GALLERY_NB = 3;
    private $slugify;

    public function __construct(Slugify $slugify)
    {
        $this->slugify = $slugify;
    }

    public function load(ObjectManager $manager): void
    {

        $faker = Factory::create('fr_FR');

        for ($i = 0; $i < self::GALLERY_NB; ++$i) {
            $gallery = new Gallery();
            $gallery->setTitle($faker->sentence());
            $gallery->setSlug($this->slugify->generate($gallery->getTitle()));
            $gallery->setDate($faker->dateTimeBetween('-1 year', 'now'));
            $manager->persist($gallery);

            $this->addReference('gallery_'.$i, $gallery);
        }

        $manager->flush();
    }
}
