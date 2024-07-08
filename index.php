<?php

require 'vendor/autoload.php';

use Saeed\Winecalculator\Handler\WineCalculatorHandlerFactory;
use Symfony\Component\Console\Application;

$application = new Application();

$application->add((new WineCalculatorHandlerFactory())());

$application->run();