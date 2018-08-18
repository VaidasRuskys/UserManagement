<?php
namespace Tests\AppBundle\Service\UserManager;

use AppBundle\Service\UserManager;
use Doctrine\ORM\EntityManager;
use PHPUnit\Framework\TestCase as BasicTestCase;

/**
 * Class TestCase
 */
class TestCase extends BasicTestCase
{
    /** @var UserManager */
    protected $instance;

    /** @var EntityManager */
    protected $entityManager;

    public function setup()
    {
        $this->entityManager = $this->createMock(EntityManager::class);
        $this->instance = new UserManager($this->entityManager);
    }
}
