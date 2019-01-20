<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../var/bootstrap.php.cache';
require_once __DIR__ . '/../app/AppKernel.php';

use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Output\ConsoleOutput;
use Symfony\Component\Console\Input\ArrayInput;

use Doctrine\Bundle\DoctrineBundle\Command\DropDatabaseDoctrineCommand;
use Doctrine\Bundle\DoctrineBundle\Command\CreateDatabaseDoctrineCommand;
use Doctrine\Bundle\DoctrineBundle\Command\Proxy\UpdateSchemaDoctrineCommand;
use Doctrine\Bundle\FixturesBundle\Command\LoadDataFixturesDoctrineCommand;

$kernel = new AppKernel('test', true); // create a "test" kernel
$kernel->boot();

$application = new Application($kernel);

global $container;
$container = $kernel->getContainer();

$configTest = $container->getParameter('config_test');
$recreateDatabase = (isset($configTest['recreateDatabase']))?$configTest['recreateDatabase']:true;
if($recreateDatabase) {
    // add the database:drop command to the application and run it
    $command = new DropDatabaseDoctrineCommand();
    $application->add($command);
    $input = new ArrayInput(array(
        'command' => 'doctrine:database:drop',
        '--force' => true,
    ));
    $command->run($input, new ConsoleOutput());

    // add the database:create command to the application and run it
    $command = new CreateDatabaseDoctrineCommand();
    $application->add($command);
    $input = new ArrayInput(array(
        'command' => 'doctrine:database:create',
    ));
    $command->run($input, new ConsoleOutput());

    // add the schema:update command to the application and run it
    $command = new UpdateSchemaDoctrineCommand();
    $application->add($command);
    $input = new ArrayInput(array(
        'command' => 'doctrine:schema:update',
        '--force' => true,
    ));
    $command->run($input, new ConsoleOutput());

    // add the doctrine:fixtures:load command to the application and run it
    $command = new LoadDataFixturesDoctrineCommand();
    $application->add($command);
    $input = new ArrayInput(array(
        'command' => 'doctrine:fixtures:load',
    ));
    $input->setInteractive(false);
    $command->run($input, new ConsoleOutput());
}