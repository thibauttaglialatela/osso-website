<?php

namespace App\DataFixtures;

use App\Entity\Event;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class EventFixtures extends Fixture
{
    public const EVENT_NB = 5;

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        for ($i = 0; $i < self::EVENT_NB; ++$i) {
            $event = new Event();
            $event->setTitle($faker->text(50));
            $event->setSummary($faker->text(200));
            $event->setBody($faker->text);
            $event->setStartAt($faker->dateTimeBetween('-1 year', '+6 months'));
            $event->setEndAt($faker->dateTimeBetween('-6 months', '+6 months'));
            $event->setLocalisation($faker->city());
            $event->setCategory('concert');
            $event->setPoster('https://picsum.photos/200/300');
            $manager->persist($event);
            $this->addReference('event_'.$i, $event);
        }

        $manager->flush();
    }
}
