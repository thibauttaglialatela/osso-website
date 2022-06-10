<?php

namespace App\DataFixtures;

use Doctrine\Persistence\ObjectManager;
use App\Entity\Instrument;
use Doctrine\Bundle\FixturesBundle\Fixture;

class InstrumentFixtures extends Fixture
{
    const INSTRUMENTS = [
        'flute' => 'Fl',
        'piccolo' => 'picc',
        'hautbois' => 'Hb',
        'clarinette' => 'Cl',
        'basson' => 'Bsn',
        'cor' => 'Cor',
        'trompette' => 'Trp',
        'trombone' => 'Tbn',
        'tuba' => 'Tuba',
        'harpe' => 'Harp',
        'percussions' => 'Perc',
        'violon 1' => 'Vl1',
        'violon 2' => 'Vl2',
        'alto' => 'Alt',
        'violoncelle' => 'Vcl',
        'contrebasse' => 'Cb',
    ];

    /**
     * @inheritDoc
     */
    public function load(ObjectManager $manager)
    {
        foreach (self::INSTRUMENTS as $key => $value) {
            $instrument = new Instrument();
            $instrument->setName($key);
            $instrument->setFctId($value);
            $manager->persist($instrument);
        }
        $manager->flush();
    }
}