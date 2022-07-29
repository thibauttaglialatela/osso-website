<?php

namespace App\DataFixtures;

use App\Entity\Musician;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class MusicianFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        // création des violons 1
        $headers = true;
        if (($handle = fopen('assets/images/violin-1.csv', 'r')) !== false) {
            if ($headers) {
                fgets($handle);
            }
            while (($line = fgetcsv($handle, 1000)) !== false) {
                $musician = new Musician();
                $musician->setFirstname($line[0]);
                $musician->setLastname($line[1]);
                $musician->addInstrument($this->getReference('Instrument_Vl1'));
                $manager->persist($musician);
            }
            fclose($handle);
        }

        // création des violons 2
        $headers = true;
        if (($handle = fopen('assets/images/violin-2.csv', 'r')) !== false) {
            if ($headers) {
                fgets($handle);
            }
            while (($line = fgetcsv($handle, 1000)) !== false) {
                $musician = new Musician();
                $musician->setFirstname($line[0]);
                $musician->setLastname($line[1]);
                $musician->addInstrument($this->getReference('Instrument_Vl2'));
                $manager->persist($musician);
            }
            fclose($handle);
        }

        // création des alti
        $headers = true;
        if (($handle = fopen('assets/images/alto.csv', 'r')) !== false) {
            if ($headers) {
                fgets($handle);
            }
            while (($line = fgetcsv($handle, 1000)) !== false) {
                $musician = new Musician();
                $musician->setFirstname($line[0]);
                $musician->setLastname($line[1]);
                $musician->addInstrument($this->getReference('Instrument_Alto'));
                $manager->persist($musician);
            }
            fclose($handle);
        }

        // création des violoncelles
        $headers = true;
        if (($handle = fopen('assets/images/cello.csv', 'r')) !== false) {
            if ($headers) {
                fgets($handle);
            }
            while (($line = fgetcsv($handle, 1000)) !== false) {
                $musician = new Musician();
                $musician->setFirstname($line[0]);
                $musician->setLastname($line[1]);
                $musician->addInstrument($this->getReference('Instrument_Vcl'));
                $manager->persist($musician);
            }
            fclose($handle);
        }

        // création des Contrebasses
        $headers = true;
        if (($handle = fopen('assets/images/bass.csv', 'r')) !== false) {
            if ($headers) {
                fgets($handle);
            }
            while (($line = fgetcsv($handle, 1000)) !== false) {
                $musician = new Musician();
                $musician->setFirstname($line[0]);
                $musician->setLastname($line[1]);
                $musician->addInstrument($this->getReference('Instrument_Cb'));
                $manager->persist($musician);
            }
            fclose($handle);
        }

        // création des flutes
        $headers = true;
        if (($handle = fopen('assets/images/flute.csv', 'r')) !== false) {
            if ($headers) {
                fgets($handle);
            }
            while (($line = fgetcsv($handle, 1000)) !== false) {
                $musician = new Musician();
                $musician->setFirstname($line[0]);
                $musician->setLastname($line[1]);
                $musician->addInstrument($this->getReference('Instrument_Fl'));
                $manager->persist($musician);
            }
            fclose($handle);
        }

        // création des hautbois
        $headers = true;
        if (($handle = fopen('assets/images/oboe.csv', 'r')) !== false) {
            if ($headers) {
                fgets($handle);
            }
            while (($line = fgetcsv($handle, 1000)) !== false) {
                $musician = new Musician();
                $musician->setFirstname($line[0]);
                $musician->setLastname($line[1]);
                $musician->addInstrument($this->getReference('Instrument_Hb'));
                $manager->persist($musician);
            }
            fclose($handle);
        }

        // création des clarinettes
        $headers = true;
        if (($handle = fopen('assets/images/clarinet.csv', 'r')) !== false) {
            if ($headers) {
                fgets($handle);
            }
            while (($line = fgetcsv($handle, 1000)) !== false) {
                $musician = new Musician();
                $musician->setFirstname($line[0]);
                $musician->setLastname($line[1]);
                $musician->addInstrument($this->getReference('Instrument_Cl'));
                $manager->persist($musician);
            }
            fclose($handle);
        }

        // création des bassons
        $headers = true;
        if (($handle = fopen('assets/images/bassoon.csv', 'r')) !== false) {
            if ($headers) {
                fgets($handle);
            }
            while (($line = fgetcsv($handle, 1000)) !== false) {
                $musician = new Musician();
                $musician->setFirstname($line[0]);
                $musician->setLastname($line[1]);
                $musician->addInstrument($this->getReference('Instrument_Bsn'));
                $manager->persist($musician);
            }
            fclose($handle);
        }

        // création des cors
        $headers = true;
        if (($handle = fopen('assets/images/horn.csv', 'r')) !== false) {
            if ($headers) {
                fgets($handle);
            }
            while (($line = fgetcsv($handle, 1000)) !== false) {
                $musician = new Musician();
                $musician->setFirstname($line[0]);
                $musician->setLastname($line[1]);
                $musician->addInstrument($this->getReference('Instrument_Cor'));
                $manager->persist($musician);
            }
            fclose($handle);
        }

        // création trompettes
        $headers = true;
        if (($handle = fopen('assets/images/trumpet.csv', 'r')) !== false) {
            if ($headers) {
                fgets($handle);
            }
            while (($line = fgetcsv($handle, 1000)) !== false) {
                $musician = new Musician();
                $musician->setFirstname($line[0]);
                $musician->setLastname($line[1]);
                $musician->addInstrument($this->getReference('Instrument_Trp'));
                $manager->persist($musician);
            }
            fclose($handle);
        }

        // création des trombones
        $headers = true;
        if (($handle = fopen('assets/images/trombone.csv', 'r')) !== false) {
            if ($headers) {
                fgets($handle);
            }
            while (($line = fgetcsv($handle, 1000)) !== false) {
                $musician = new Musician();
                $musician->setFirstname($line[0]);
                $musician->setLastname($line[1]);
                $musician->addInstrument($this->getReference('Instrument_Tbne'));
                $manager->persist($musician);
            }
            fclose($handle);
        }

        // création des tubas
        $headers = true;
        if (($handle = fopen('assets/images/tuba.csv', 'r')) !== false) {
            if ($headers) {
                fgets($handle);
            }
            while (($line = fgetcsv($handle, 1000)) !== false) {
                $musician = new Musician();
                $musician->setFirstname($line[0]);
                $musician->setLastname($line[1]);
                $musician->addInstrument($this->getReference('Instrument_Tuba'));
                $manager->persist($musician);
            }
            fclose($handle);
        }

        // création des percussions
        $headers = true;
        if (($handle = fopen('assets/images/percussion.csv', 'r')) !== false) {
            if ($headers) {
                fgets($handle);
            }
            while (($line = fgetcsv($handle, 1000)) !== false) {
                $musician = new Musician();
                $musician->setFirstname($line[0]);
                $musician->setLastname($line[1]);
                $musician->addInstrument($this->getReference('Instrument_Perc'));
                $manager->persist($musician);
            }
            fclose($handle);
        }

        // création des harpes
        $headers = true;
        if (($handle = fopen('assets/images/harp.csv', 'r')) !== false) {
            if ($headers) {
                fgets($handle);
            }
            while (($line = fgetcsv($handle, 1000)) !== false) {
                $musician = new Musician();
                $musician->setFirstname($line[0]);
                $musician->setLastname($line[1]);
                $musician->addInstrument($this->getReference('Instrument_Harp'));
                $manager->persist($musician);
            }
            fclose($handle);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            InstrumentFixtures::class,
        ];
    }
}
