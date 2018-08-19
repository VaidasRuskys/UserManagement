<?php

namespace AppBundle\DataFixtures;

use AppBundle\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $adminUser = new User();
        $adminUser
            ->setUsername('admin')
            ->setEmail('admin@admin.com')
            ->setEnabled(true)
            ->setPlainPassword('admin')
            ->addRole(User::ROLE_ADMIN);

        $manager->persist($adminUser);
        $manager->flush();
    }
}