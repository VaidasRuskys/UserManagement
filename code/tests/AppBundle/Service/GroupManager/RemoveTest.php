<?php

namespace Tests\AppBundle\Service\GroupManager;

use AppBundle\Entity\Group;
use AppBundle\Entity\User;
use Doctrine\Common\Collections\ArrayCollection;

class RemoveTest extends TestCase
{
    /**
     * @expectedException \AppBundle\Service\Exception\GroupNotEmptyException
     */
    public function testFailedToRemove()
    {
        $group = new Group('Group');
        $user = new User();
        $group->setUsers(new ArrayCollection([$user]));

        $this->instance->remove($group);
    }
}
