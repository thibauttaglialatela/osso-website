<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Compositor;

class CompositorFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $handle = fopen('assets/images/Compositeur.csv', 'r');
        $header = true;
        if ($handle !== false) {
            if ($header) {
                fgets($handle);
            }
            while (($line = fgetcsv($handle, 1000, ",")) !== false) {
                $compositor = new Compositor();
                $compositor->setName($line[0]);
                $manager->persist($compositor);
                $this->addReference($line[0], $compositor);
            }
            fclose($handle);
        }


        $manager->flush();
    }
}
