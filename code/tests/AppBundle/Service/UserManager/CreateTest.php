<?php

namespace Tests\AppBundle\Service\UserManager;

use AppBundle\Entity\User;

class CreateTest extends TestCase
{
    public function testCreateSuccess()
    {
        $group = $this->instance->create('UserName');
        $this->assertInstanceOf(User::class, $group, 'Failed to create user');
    }

    /**
     * @expectedException \AppBundle\Service\Exception\UserNameInvalidException
     */
    public function testCreateFailed()
    {
        $this->instance->create('');
    }
}
