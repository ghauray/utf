<?php

namespace Batiweb\Socle\Integration;

use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\DependencyInjection\Container;

/**
 * Class ExampleAbstractIntegrationTestCase
 * @package Batiweb\Socle\Integration
 */
abstract class AbstractIntegrationTestCase extends WebTestCase {

    /**
     * Conteneur IOC
     * @var Container
     */
    protected $container;

    /**
     * EntityManager
     * @var EntityManager
     */
    protected $entityManager;

    /**
     * Si vrai, alors auto rollback
     * @var boolean
     */
    protected $autoRollback;

    /**
     * Constructeur
     */
    function __construct() {
        parent::__construct();
        \Phockito::include_hamcrest();

        global $container;
        $this->container = $container;
        $this->entityManager = $this->container->get('doctrine')->getManager();

        $configTest = $this->container->getParameter('config_test');
        $this->autoRollback = (isset($configTest['autoRollback']) && $configTest['autoRollback'] != "")?$configTest['autoRollback']:true;
        $this->backupGlobals = (isset($configTest['backupGlobals']) && $configTest['backupGlobals'] != "")?$configTest['backupGlobals']:false;
    }

    /**
     * This method is called before each test.
     */
    public function setUp() {
        parent::setUp();

        $this->entityManager = $this->container->get('doctrine')->getManager();
        if ($this->autoRollback) {
            $this->entityManager->beginTransaction();
        }
        $this->entityManager->clear();
        // Clear des POST
        $_POST = array();
    }

    /**
     * Clean up Kernel usage in this test. (after each test)
     */
    public function tearDown() {
        if ($this->autoRollback) {
            $this->entityManager->rollback();
        }

        parent::tearDown();
        $this->entityManager->clear();
        $this->entityManager->close();
        $this->entityManager = null;
    }
}