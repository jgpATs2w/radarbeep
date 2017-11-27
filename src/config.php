<?php

define( 'VERSION_NUMBER', 'rc1'  );

//DB parameters
define( 'DBHOST', 'localhost' );
define( 'DBUSER', 'gev' );
define( 'DBPASS', 'Gev2015@' );
define( 'DBDB', "gev" );
define( 'DB_MEMORY_LIMIT', 10000);

define( 'SRC', realpath( __DIR__ ).'/' );

/**
*
* No need to touch from here
*
**/

date_default_timezone_set( 'Europe/Madrid' );

/*
* Debugging, set statically with defined or dinamically with ?debug
*/
// Mock state: use to return quick responses to test integration
if(isset($_GET) && isset($_GET['mock']))
  define( 'MOCK', true );
else
  if(!defined('MOCK'))
    define( 'MOCK', false );
  //allow phpunit to define

// Debug state
if(isset($_GET) && isset($_GET['debug']))
  define( 'DEBUG', true );
else
    if(!defined('DEBUG'))
      define( 'DEBUG', false );//switch to false in production
    //allow phpunit to define

error_reporting(-1);
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);

//Prepare third party tools autoload, configured in composer.json
if(is_file( 'vendor/autoload.php'))
  require 'vendor/autoload.php';

//Slim settings
$settings= array(
    'settings' => [
        'displayErrorDetails' => true, // set to false in production
        'addContentLengthHeader' => false, // Allow the web server to send the content-length header
        // Renderer settings TODO remove
        'renderer' => [
            'template_path' => __DIR__ .'/../view/',
        ],
        // Monolog settings
        'logger' => [
            'name' => 'gpo',
            'path' => __DIR__ . '/../../logs/app.log',
        ],
    ],
);

?>
