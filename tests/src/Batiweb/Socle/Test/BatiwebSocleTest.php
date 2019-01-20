<?php

namespace Batiweb\Socle\Test;

use Symfony\Component\Process\Process;

/**
 * Class de test du socle de projet batiweb en lui même
 * @package Batiweb\Socle\Test
 */
class BatiwebSocleTest extends AbstractTestCase {

    public function testRabbitMQ() {
        $rootDir = $this->container->get('kernel')->getRootDir();

        // Démarrage du consumer
        $process = new Process('php7.2 "'. $rootDir .'\..\bin\console" rabbitmq:consumer test1 --env=test');
        $process->start();

        // Envoi du message sur le producer
        $this->container->get('old_sound_rabbit_mq.test1_producer')->publish(serialize('the winning code is : RABBIT MQ !'));

        // Analyse de la sortie du consumer
        sleep(3);
        $result = $process->getOutput();
        $this->assertContains("the winning code is : RABBIT MQ !", $result, "RABBIT MQ Integration Error (Server is alive ?)");

        // Arret du consumer
        $process->stop();
    }
}