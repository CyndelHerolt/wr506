<?php

namespace App\DataFixtures;

use App\Entity\Movie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class MovieFixtures extends Fixture
{
    // définir l'ordre de chargement des fixtures
    public function getOrder(): int
    {
        return 3;
    }

    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i < 30; ++$i) {
            $movie = new Movie();
            $movie->setTitle('title '.$i);
            $movie->setDescription('description '.$i);
            $movie->setReleaseDate(new \DateTime());
            $movie->setDuration(120+$i);
            $movie->setCategory($this->getReference('category_'.rand(1, 4)));

            $actors = [];
            foreach (range(1, rand(2, 6)) as $j) {
                $actor = $this->getReference('actor_'.rand(1, 9));
                if (!in_array($actor, $actors)) {
                    $actors[] = $actor;
                    $movie->addActor($actor);
                }
            }

            $manager->persist($movie);
        }

        $manager->flush();
    }
}