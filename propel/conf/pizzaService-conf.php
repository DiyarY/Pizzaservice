<?php
// This file generated by Propel 1.7.2 convert-conf target
// from XML runtime conf file /vagrant/propel/runtime-conf.xml
$conf = array (
  'datasources' => 
  array (
    'pizzaService' => 
    array (
      'adapter' => 'mysql',
      'connection' => 
      array (
        'dsn' => 'mysql:host=localhost;dbname=pizzaService',
        'user' => 'pizzaUser',
        'password' => 'pizzaKey',
      ),
    ),
    'default' => 'pizzaService',
  ),
  'generator_version' => '1.7.2',
);
$conf['classmap'] = include(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'pizzaService-classmap.php');
return $conf;