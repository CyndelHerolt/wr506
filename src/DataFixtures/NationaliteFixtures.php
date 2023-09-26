<?php

namespace App\DataFixtures;

use App\Entity\Nationalite;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class NationaliteFixtures extends Fixture implements OrderedFixtureInterface
{
    public function getOrder(): int
    {
        return 1;
    }

    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i < 5; ++$i) {
            $nationalite = new Nationalite();
            $nationalite->setName('Nationalite '.$i);
            $manager->persist($nationalite);
            $this->addReference('nationalite_'.$i, $nationalite);
        }

        $manager->flush();
    }
}
