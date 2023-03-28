<?php

/*
 * A propel-setup application so the propel-code can be executed.
 */

//Include the main Propel script
require_once __DIR__."/vendor/propel/propel1/runtime/lib/Propel.php";

//Initialize Propel with the runtime configuration
Propel::init(__DIR__."/propel/conf/pizzaService-conf.php");

//Generated classes
set_include_path(__DIR__."/propel/models/pizzaService/" . PATH_SEPARATOR . get_include_path());