<?php

require __DIR__ . '/vendor/symfony/class-loader/Symfony/Component/ClassLoader/Psr4ClassLoader.php';
use Symfony\Component\ClassLoader\Psr4ClassLoader;

$loader = new Psr4ClassLoader();
$loader->addPrefix('DateOperations\\', __DIR__ . '/src/DateOperations');
$loader->addPrefix('DateOperations\\Interfaces', __DIR__ . '/src/DateOperations/Interfaces');
$loader->register();
