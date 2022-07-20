<?php

namespace App\DataFixtures;

use App\Entity\Instrument;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use League\Csv\Exception;
use League\Csv\Reader;

class InstrumentFixtures extends Fixture
{
    /**
     * {@inheritDoc}
     *
     * @throws Exception
     */
    public function load(ObjectManager $manager)
    {
        $fileHandler = Reader::createFromPath('assets/images/Instrument.csv');
        $fileHandler->setHeaderOffset(0);
        foreach ($fileHandler as $record) {
            $instrumentId = $record['fct_id'];
            $instrument = new Instrument();
            $instrument->setName($record['name']);
            $instrument->setFctId($record['fct_id']);

            $manager->persist($instrument);
            $this->addReference('Instrument_'.$instrumentId, $instrument);
        }
        $manager->flush();
    }
}
