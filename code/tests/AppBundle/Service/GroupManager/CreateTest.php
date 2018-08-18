<?php

namespace Tests\AppBundle\Service\GroupManager;

use AppBundle\Entity\Group;

class CreateTest extends TestCase
{
    public function testCreateSuccess()
    {
        $group = $this->instance->create('GroupName');
        $this->assertInstanceOf(Group::class, $group, 'Failed to create group');
    }

    /**
     * @expectedException \AppBundle\Service\Exception\GroupNameInvalidException
     */
    public function testCreateFailed()
    {
        $this->instance->create('');
    }
}
