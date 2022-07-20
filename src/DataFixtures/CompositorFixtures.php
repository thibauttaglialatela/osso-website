<?php

namespace App\DataFixtures;

use App\Entity\Compositor;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CompositorFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $handle = fopen('assets/images/Compositeur.csv', 'r');
        $header = true;
        if (false !== $handle) {
            if ($header) {
                fgets($handle);
            }
            while (($line = fgetcsv($handle, 1000, ',')) !== false) {
                $compositor = new Compositor();
                $compositor->setName($line[0]);
                $manager->persist($compositor);
                $this->addReference('compositor_'.$line[0], $compositor);
            }
            fclose($handle);
        }

        $manager->flush();
    }
}
