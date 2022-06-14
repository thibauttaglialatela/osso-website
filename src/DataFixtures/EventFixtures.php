<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Event;
use Faker\Factory;

class EventFixtures extends Fixture
{
    public const EVENT_NB = 5;

    public function load(ObjectManager $manager): void
    {

        $faker = Factory::create('fr_FR');

        for ($i = 0; $i < self::EVENT_NB; $i++) {
            $event = new Event();
            $event->setTitle($faker->text(50));
            $event->setSummary($faker->text(200));
            $event->setBody($faker->text);
            $event->setDate($faker->dateTimeInInterval('+2 weeks', '+1 year'));
            $event->setCategory('concert');
            $event->setPoster('https://picsum.photos/200/300');
            $manager->persist($event);
            $this->addReference('event_' . $i, $event);

        }

        $manager->flush();
    }
}
