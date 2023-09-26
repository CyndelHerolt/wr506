<?php

namespace App\DataFixtures;

use App\Entity\Actor;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ActorFixtures extends Fixture
{
    // définir l'ordre de chargement des fixtures
    public function getOrder(): int
    {
        return 2;
    }

    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i < 10; ++$i) {
            $actor = new Actor();
            $actor->setFirstName('firstname '.$i);
            $actor->setLastName('lastname '.$i);
            $manager->persist($actor);
            $this->addReference('actor_'.$i, $actor);
        }

        $manager->flush();
    }
}
