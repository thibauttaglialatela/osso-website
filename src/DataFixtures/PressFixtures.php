<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use App\Entity\Press;

class PressFixtures extends Fixture
{
    public const ARTICLE_NB = 5;
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        for ($i = 0; $i < self::ARTICLE_NB; $i++) {
            $press = new Press();
            $press->setTitle($faker->realText(100));
            $press->setNewspaper('La République des Pyrénées');
            $press->setArticleDate($faker->dateTimeBetween('-3 months', 'now'));
            $press->setArticleLink($faker->url());
            $manager->persist($press);
        }

        $manager->flush();
    }
}
