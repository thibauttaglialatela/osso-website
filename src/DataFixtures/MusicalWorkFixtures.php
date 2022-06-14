<?php

namespace App\DataFixtures;


use App\Entity\MusicalWork;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use League\Csv\Exception;
use League\Csv\Reader;

class MusicalWorkFixtures extends Fixture implements DependentFixtureInterface
{
    /**
     * @throws Exception
     */
    public function load(ObjectManager $manager): void
    {

        $handler = Reader::createFromPath('assets/images/Mozart_work.csv', 'r');
        $handler->setHeaderOffset(0);
        foreach ($handler as $record) {
            $musicalWork = new MusicalWork();
            $musicalWork->setTitle($record['title']);
            $musicalWork->setStatus($record['status']);
            $musicalWork->setCompositor($this->getReference('compositor_Mozart'));
            $musicalWork->setEvent($this->getReference('event_2'));

            $manager->persist($musicalWork);
        }



        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
           CompositorFixtures::class,
            EventFixtures::class,
        ];
    }
}
