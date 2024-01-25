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


        for ($i = 0; $i <= 30; $i++) :
            $formation = new Livre();
            $formation->setTitre($faker->words(3, true))
                ->setAuteur($faker->name($gender = null|'male'|'female'))
                ->setEditeur($faker->company())
                ->setIsbn($faker->isbn10())
                ->setDatePublication($faker->dateTime())
                ->setImage($faker->image(null, 240, 320))
                ->setResume($faker->paragraph())
                ;
            $manager->persist($formation);
        endfor;

        $manager->flush();
    }
}
