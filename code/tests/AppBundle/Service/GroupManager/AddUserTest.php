<?php

namespace Tests\AppBundle\Service\GroupManager;

use AppBundle\Entity\Group;
use AppBundle\Entity\User;

class AddUserTest extends TestCase
{
    public function testUserAdded()
    {
        $user = new User();
        $group = new Group('Group');

        $this->instance->addUser($group, $user);
        $this->assertEquals($group, $user->getGroups()->first(), 'Failed to add user');
    }
}
