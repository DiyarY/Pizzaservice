<?php

namespace Pizzaservice;

require __DIR__ . '/vendor/autoload.php';
require_once "setup.php";

/*
 * Test script.
 *
 * Sets and includes a new value into pizza table of the pizzaService-database.
 */

$pizza = new Pizza();

$pizza->setName("Tunfischpizza");
$pizza->setPrice(6.90);
$pizza->save();

echo $pizza->getId()."\n";
echo $pizza->getName()."\n";
echo $pizza->getPrice()."\n";
