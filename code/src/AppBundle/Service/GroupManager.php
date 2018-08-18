<?php

namespace AppBundle\Service;

use AppBundle\Entity\Group;
use AppBundle\Entity\User;
use AppBundle\Service\Exception\GroupNotEmptyException;
use Doctrine\ORM\EntityManager;

class GroupManager
{
    /** @var EntityManager */
    protected $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param $groupName
     * @return Group
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function create($groupName)
    {
        $group = new Group($groupName);

        $this->entityManager->persist($group);
        $this->entityManager->flush();

        return $group;
    }

    /**
     * @param Group $group
     * @throws GroupNotEmptyException
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function remove(Group $group)
    {
        if (!$group->getUsers()->isEmpty()) {
            throw new GroupNotEmptyException($group->getId());
        }

        $this->entityManager->remove($group);
        $this->entityManager->flush();
    }

    /**
     * @param Group $group
     * @param User $user
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function addUser(Group $group, User $user)
    {
        $user->addGroup($group);

        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }

    /**
     * @param Group $group
     * @param User $user
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function removeUser(Group $group, User $user)
    {
        $user->removeGroup($group);

        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }
}
