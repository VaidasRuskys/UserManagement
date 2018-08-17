<?php

namespace AppBundle\Service;

use AppBundle\Entity\User;
use Doctrine\ORM\EntityManager;

class UserManager
{
    /** @var EntityManager */
    protected $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param $username
     * @return User
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function create($username)
    {
        $user = new User();
        $user
            ->setUsername($username)
            ->setEmail($username)
            ->setPlainPassword($username)
            ->setEnabled(true);

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return $user;
    }
}