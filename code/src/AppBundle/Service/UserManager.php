<?php

namespace AppBundle\Service;

use AppBundle\Entity\User;
use AppBundle\Service\Exception\UserNameInvalidException;
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
     * @throws UserNameInvalidException
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function create($username)
    {
        if (empty($username)) {
            throw new UserNameInvalidException();
        }

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

    /**
     * @param User $user
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function remove(User $user)
    {
        $this->entityManager->remove($user);
        $this->entityManager->flush();
    }
}
