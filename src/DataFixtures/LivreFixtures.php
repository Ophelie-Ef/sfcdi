<?php

namespace App\DataFixtures;

use App\Entity\Livre;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class LivreFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        for ($i = 0; $i <= 50; $i++) :

            $livre = new Livre();
            $livre->setTitre($faker->words(3, true))
                ->setAuteur($faker->name())
                ->setEditeur($faker->company())
                ->setIsbn($faker->isbn10())
                ->setDatePublication($faker->dateTime())
                ->setImage($faker->imageUrl())
                ->setResume($faker->paragraph())
                ;
            $manager->persist($livre);
            
        endfor;

        $manager->flush();
    }
}
