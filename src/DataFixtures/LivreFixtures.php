<?php

namespace App\DataFixtures;

use App\Entity\Genre;
use App\Entity\Livre;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class LivreFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        $genres = [];

        for ($h = 0; $h <= 5; $h++) :

            $genre = new Genre();
            $genre->setNom($faker->word())
                ->setDescription($faker->sentence());
            $genres[] = $genre;
            $manager->persist($genre);

        endfor;

        for ($i = 0; $i <= 50; $i++) :

            $livre = new Livre();
            $livre->setTitre($faker->words(3, true))
                ->setAuteur($faker->name())
                ->setEditeur($faker->company())
                ->setIsbn($faker->isbn10())
                ->setDatePublication($faker->dateTime())
                ->setImage($faker->imageUrl())
                ->setResume($faker->paragraph());

            for ($j = 0; $j < mt_rand(1, 13); $j++) :

                $livre->addGenre($genres[mt_rand(0, count($genres) - 1)]);

            endfor;

            $manager->persist($livre);

        endfor;

        $manager->flush();
    }
}
