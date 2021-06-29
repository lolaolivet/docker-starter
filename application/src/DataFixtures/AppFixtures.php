<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Factory\CountryFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\DifficultyLevel;
use App\Factory\DifficultyLevelFactory;
use App\Factory\LinesFactory;
use App\Factory\FeedbackFactory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager)
    {
        $d = DifficultyLevelFactory::createMany(6);
        CountryFactory::createMany(4);

        for ($i = 0; $i < 20; $i++) {
            FeedbackFactory::createOne(['line' => LinesFactory::new()->createOne(['difficulties' => DifficultyLevelFactory::randomRange(1, 5), 'country' => CountryFactory::random()])->object()]);
        }

        $user_admin = new User();

        $user_admin->setUsername('Admin');
        $user_admin->setPassword($this->passwordHasher->hashPassword($user_admin, 'root'));
        $user_admin->setRoles(['ROLE_USER','ROLE_ADMIN']);
        $user_admin->setApiToken('iamtheadmintoken');
        $manager->persist($user_admin);

        $user = new User();

        $user->setUsername('Lola');
        $user->setPassword($this->passwordHasher->hashPassword($user, 'Lola'));
        $user->setRoles(['ROLE_USER']);
        $user->setApiToken('iamtheusertoken');
        $manager->persist($user);


        $manager->flush();
    }
}
