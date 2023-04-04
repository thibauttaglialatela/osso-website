<?php

namespace App\DataFixtures;

use App\Entity\Contenu;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ContenuFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        $orchestraHistory = new Contenu();
        $orchestraHistory->setIdentifier('orchestra-history');
        $orchestraHistory->setTitle("A propos de l'Orchestre Symphonique du Sud-Ouest");
        $orchestraHistory->setBody($faker->realTextBetween());
        $manager->persist($orchestraHistory);

        $directorBiography = new Contenu();
        $directorBiography->setIdentifier('director-biography');
        $directorBiography->setTitle('Biographie d\'Alain Perpétue');
        $directorBiography->setBody('Alain PERPETUE s’est intéressé dès ses 19/20 ans à promouvoir l’éducation
                            artistique dans le piémont pyrénéen à la fin de sa formation au Conservatoire de Pau (orgue,
                            basson, flûte à bec, écriture et chant choral) puis de Saint Maur des Fossés, Paris et enfin
                            à Chalon sur Saône. Une dizaine d’années en Soule et Basse-Navarre dans les années 80 lui
                            ont permis de tisser des liens entre traditions orales et chant choral en créant les
                            Rencontres de traditions orales, la Fédération des chœurs du Pays Basque et en présentant un
                            DEA d’ethnomusicologie du domaine basque. La direction d’orchestre et de chœur (Angoulême,
                            la Région Centre) et l’obtention du CA de directeur des établissements contrôlés par l’Etat
                            (Strasbourg, Tarn et Tarbes) lui permettront de contribuer au rapprochement de la formation
                            professionnelle et des pratiques amateurs. La direction de l’OSSO, à l’invitation de son
                            fondateur Bernard SALLES, constitue un des faits marquants de cette démarche.');
        $manager->persist($directorBiography);

        $administrationMembers = new Contenu();
        $administrationMembers->setIdentifier('conseil administration');
        $administrationMembers->setTitle('Membres du conseil d\'administration et du bureau');
        $administrationMembers->setBody(
            'Président : Jean-Baptiste BAUDRAN
                   Vice-président : Guillaume RENAUD
                    Trésoriére : Lise LAYEILLON
                    Secrétaire : Anne TERRIERE'
        );
        $manager->persist($administrationMembers);

        $manager->flush();
    }
}
