<?php

//require __DIR__ . '/vendor/symfony/class-loader/Symfony/Component/ClassLoader/Psr4ClassLoader.php';
use Symfony\Component\ClassLoader\Psr4ClassLoader;

$loader = new Psr4ClassLoader();
$loader->addPrefix('AvantiDates\\', __DIR__ . '/src/AvantiDates');
$loader->addPrefix('AvantiDates\\Interfaces', __DIR__ . '/src/AvantiDates/Interfaces');
$loader->register();
