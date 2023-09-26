<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture implements OrderedFixtureInterface
{
    // définir l'ordre de chargement des fixtures
    public function getOrder(): int
    {
        return 3;
    }

    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i < 5; ++$i) {
            $category = new Category();
            $category->setName('Category '.$i);
            $manager->persist($category);
            $this->addReference('category_'.$i, $category);
        }

        $manager->flush();
    }
}
