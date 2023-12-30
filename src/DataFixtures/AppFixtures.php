<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
         $user = new User();
         $user->setEmail('admin@mail.com');
         $user->setPassword('$2y$13$jU8CXH6LLZ7JFC2cpohMruzZwkOJwjl/ufW7gX0xf.OJjlejGt81i');
         $user->setRoles(['ROLE_ADMIN']);
         $manager->persist($user);

        $manager->flush();
    }
}
