<?php

namespace Pizzaservice;

require __DIR__. "/vendor/autoload.php";
require_once "setup.php";

use Pizzaservice\Propel\Models\Pizza;
use Pizzaservice\Propel\Models\PizzaQuery;

/*
 * Test script.
 *
 * Sets and includes a new value into pizza table of the pizzaService-database.
 */

$pizza = new Pizza();

$pizza = PizzaQuery::create()
    ->getName()
    ->find();
