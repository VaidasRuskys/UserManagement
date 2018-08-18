<?php

namespace Tests\AppBundle\Service\GroupManager;

use AppBundle\Entity\Group;
use AppBundle\Entity\User;
use Doctrine\Common\Collections\ArrayCollection;

class RemoveUserTest extends TestCase
{
    public function testUserRemoved()
    {
        $user = new User();
        $group = new Group('Group');
        $user->setGroups(new ArrayCollection([$group]));

        $this->instance->removeUser($group, $user);
        $this->assertEmpty($user->getGroups(), 'Failed to remove user');
    }
}
