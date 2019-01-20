<?php
/**
 * Created by PhpStorm.
 * User: Pigcell
 * Date: 20/01/2019
 * Time: 16:17
 */

namespace Utf\CoreBundle\Service;

use Psr\Log\LoggerInterface;

/**
 * Class AbstractService
 * @package Utf\CoreBundle\Service
 */
abstract class AbstractService {

    /**
     * Logger
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * @return LoggerInterface
     */
    public function getLogger() {
        return $this->logger;
    }
    /**
     * @param LoggerInterface $logger
     */
    public function setLogger($logger) {
        $this->logger = $logger;
    }
}