<?php

require __DIR__.'/vendor/autoload.php';

use Symfony\Component\Console\Application;

$console = new Application();

$em = $app['orm.em'];

$helperSet = new \Symfony\Component\Console\Helper\HelperSet(array(
    'db' => new \Doctrine\DBAL\Tools\Console\Helper\ConnectionHelper($em->getConnection()),
    'em' => new \Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper($em),
    'dialog' => new \Symfony\Component\Console\Helper\QuestionHelper(),
));

$console->setHelperSet($helperSet);

$console->add(new \Doctrine\DBAL\Migrations\Tools\Console\Command\DiffCommand());
$console->add(new \Doctrine\DBAL\Migrations\Tools\Console\Command\ExecuteCommand());
$console->add(new \Doctrine\DBAL\Migrations\Tools\Console\Command\GenerateCommand());
$console->add(new \Doctrine\DBAL\Migrations\Tools\Console\Command\MigrateCommand());
$console->add(new \Doctrine\DBAL\Migrations\Tools\Console\Command\StatusCommand());
$console->add(new \Doctrine\DBAL\Migrations\Tools\Console\Command\VersionCommand());

return $console;