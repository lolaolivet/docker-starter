<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\DifficultyLevel;
use App\Factory\DifficultyLevelFactory;
use App\Factory\LinesFactory;
use App\Factory\FeedbackFactory;
use App\Entity\FeedBack;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

//        $d = DifficultyLevelFactory::createMany(6);
//
//        for ($i = 0; $i < 20; $i++) {
//            FeedbackFactory::createOne(['line' => LinesFactory::new()->createOne(['difficulty' => DifficultyLevelFactory::randomRange(1, 5)])->object()]);
//        }

        $user = new User();

        $user->setUsername('Admin');
        $user->setPassword('root');
        $user->setRoles(['ROLE_USER','ROLE_ADMIN']);

        $manager->flush();
    }
}
