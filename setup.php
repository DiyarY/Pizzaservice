<?php

//Include the main Propel script
require_once "vendor/propel/propel1/runtime/lib/Propel.php";

//Initialize Propel with the runtime configuration
Propel::init("propel/build/conf/pizzaService-conf.php");

//Generated classes
set_include_path("propel/build/classes" . PATH_SEPARATOR . get_include_path());