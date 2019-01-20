<?php

namespace Batiweb\Socle\Test\Mock;

use OldSound\RabbitMqBundle\RabbitMq\ConsumerInterface;
use PhpAmqpLib\Message\AMQPMessage;

/**
 * Class BatiwebConsumerMock
 * Permet de vérifier que rabbitMQ est bien en place sur le projet
 * @package Batiweb\Socle\Mock
 */
class BatiwebConsumerMock implements ConsumerInterface {

    /**
     * @param AMQPMessage $msg
     * @return bool
     */
    public function execute(AMQPMessage $msg) {
        echo $msg->body . "\n";
        return true;
    }
}