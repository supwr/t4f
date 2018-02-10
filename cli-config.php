<?php

require_once "vendor/autoload.php";

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Console\ConsoleRunner;

$paths = array('src/Entities/');
$isDevMode = false;

// the connection configuration
$dbParams = array(
'driver'   => 'pdo_mysql',
'user'     => 'root',
'password' => 'root',
'dbname'   => 't4f',
);

$config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);

// replace with mechanism to retrieve EntityManager in your app
$entityManager = EntityManager::create($dbParams, $config);

$helperSet = ConsoleRunner::createHelperSet($entityManager);