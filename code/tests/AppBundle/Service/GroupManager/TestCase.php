<?php
namespace Tests\AppBundle\Service\GroupManager;

use AppBundle\Service\GroupManager;
use Doctrine\ORM\EntityManager;
use PHPUnit\Framework\TestCase as BasicTestCase;

/**
 * Class TestCase
 */
class TestCase extends BasicTestCase
{
    /** @var GroupManager */
    protected $instance;

    /** @var EntityManager */
    protected $entityManager;

    public function setup()
    {
        $this->entityManager = $this->createMock(EntityManager::class);
        $this->instance = new GroupManager($this->entityManager);
    }
}
