<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\DifficultyLevel;
use App\Factory\DifficultyLevelFactory;
use App\Factory\LinesFactory;
use App\Factory\FeedbackFactory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        // $difficultyLevel = new DifficultyLevel();
        // $difficultyLevel->setDifficulty('Facile');
        // $difficultyLevel->setNotationFr('F');
        // $difficultyLevel->setNotationDe('A');
        // $difficultyLevel->setColour('#34e5eb');
        // $manager->persist($difficultyLevel);

        // $difficultyLevel2 = new DifficultyLevel();
        // $difficultyLevel2->setDifficulty('Difficile');
        // $difficultyLevel2->setNotationFr('D');
        // $difficultyLevel2->setNotationDe('D');
        // $difficultyLevel2->setColour('#eb345c');
        // $manager->persist($difficultyLevel2);

        $d = DifficultyLevelFactory::createMany(6);


// $manager
        // dd($d);
        $f = LinesFactory::createMany(10, ['difficulty' => DifficultyLevelFactory::randomRange(1, 5)]);
        // dd($f->object);

        // $feedbacks = FeedbackFactory::createMany(20, ['line' => LinesFactory::randomRange(1, 10)->getId()]);


        $manager->flush();
    }
}
