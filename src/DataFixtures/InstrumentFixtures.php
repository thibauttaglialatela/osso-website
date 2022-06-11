<?php

namespace App\DataFixtures;

use Doctrine\Persistence\ObjectManager;
use App\Entity\Instrument;
use Doctrine\Bundle\FixturesBundle\Fixture;
use League\Csv\Reader;

class InstrumentFixtures extends Fixture
{

    /**
     * @inheritDoc
     */
    public function load(ObjectManager $manager)
    {
        $fileHandler = Reader::createFromPath('assets/images/Instrument.csv');
        $fileHandler->setHeaderOffset(0);
        $i = 0;
        foreach ($fileHandler as $record) {
            $instrument = new Instrument();
            $instrument->setName($record['name']);
            $instrument->setFctId($record['fct_id']);

            $manager->persist($instrument);
            $this->addReference('Instrument_' . $i, $instrument);
        }
        $manager->flush();

    }
}