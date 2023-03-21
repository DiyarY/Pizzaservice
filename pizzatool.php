#!/usr/bin/env php
<?php



require_once __DIR__ . "/vendor/autoload.php";
require_once "setup.php";

/*
 * This php-application serves as a run-application to execute the implemented commands over the command-line.
 */

use Pizzaservice\cli\commands\CreateIngredientCommand;
use Pizzaservice\cli\commands\ListIngredientsCommand;
use Pizzaservice\cli\commands\CreatePizzaCommand;
use Pizzaservice\cli\commands\ListPizzaCommand;
use Pizzaservice\cli\commands\CreateCustomerCommand;
use Pizzaservice\cli\commands\ListCustomersCommand;
use Pizzaservice\cli\commands\ListOrdersCommand;
use Symfony\Component\Console\Application;

$application = new Application();

$application->add(new ListCustomersCommand());
$application->add(new CreateCustomerCommand());
$application->add(new CreatePizzaCommand());
$application->add(new ListPizzaCommand());
$application->add(new CreateIngredientCommand());
$application->add(new ListIngredientsCommand());
$application->add(new ListOrdersCommand());

$application->run();