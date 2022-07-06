#!/usr/bin/env php
<?php



require_once __DIR__ . "/vendor/autoload.php";
require_once "setup.php";

/*
 * This php-application serves as a run-application to execute the implemented commands over the command-line.
 */

use Pizzaservice\cli\commands\CreateIngredientCommand;
use Pizzaservice\cli\commands\ListIngredientCommand;
use Pizzaservice\cli\commands\CreatePizzaCommand;
use Pizzaservice\cli\commands\ListPizzaCommand;
use Symfony\Component\Console\Application;

$application = new Application();

$application->add(new CreatePizzaCommand());
$application->add(new ListPizzaCommand());
$application->add(new CreateIngredientCommand());
$application->add(new ListIngredientCommand());

$application->run();