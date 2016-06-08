<?php

// Load Nette Framework
if (file_exists(__DIR__ . '/../vendor/autoload.php')) {
    include __DIR__ . '/../vendor/autoload.php';
} else {
    die('Install Nette using `composer update`');
}

// Configure application
$configurator = new Nette\Configurator;

// Enable Nette Debugger for error visualisation & logging
// aktivuje laděnku pouze pro dané ip adresy
// RFIXME - dodelat error presenter ruzny pro admina, front apod.
Tracy\Debugger::$strictMode = TRUE;
//$configurator->setDebugMode($configurator::NONE);
$configurator->setDebugMode(array('192.168.2.105', '79.127.243.82', '195.39.58.146')); #-- doma-kopr (z win), doma-kopr-inet, tawesco
$configurator->enableDebugger(__DIR__ . '/../log');

// Enable RobotLoader - this will load all classes automatically
$configurator->setTempDirectory(__DIR__ . '/../temp');
$configurator->createRobotLoader()->addDirectory(__DIR__)->register();

// Create Dependency Injection container from config.neon file
$configurator->addConfig(__DIR__ . '/Config/config.neon');
if (file_exists(__DIR__ . '/Config/config.local.neon')) {
    $configurator->addConfig(__DIR__ . '/Config/config.local.neon');
}
$container = $configurator->createContainer();

// Setup modules route
$router = $container->getService('router');
foreach ($container->parameters['modules'] as $module) {
    $moduleClass = new $module;
    $moduleClass->setupRouter($router);
}

return $container;