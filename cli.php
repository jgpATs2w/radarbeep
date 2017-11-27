<?php

if(!isset($argv[1])){
  die("Comando para ejecutar funciones de librerias.\n\n\n Uso:\n php cli.php namespace metodo [argumentos]\n\n\n P.e. php cli.php generadores read\n\n");
}
define('PROJECT_ROOT', realpath(__DIR__ ) . '/');
  define('PHPUNIT', true);
  define('BASE_URI', 'http://localhost/a-geval/v1/');//TODO generate from $_SERVER
  define('PHPUNIT_CLEAN_END', true);

error_reporting(E_ALL & ~E_DEPRECATED & ~E_NOTICE);
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  date_default_timezone_set('UTC');
  define( 'PRINT_DIE' , false );

  define( 'DEBUG', true );

require PROJECT_ROOT . 'src/config.php';
  require PROJECT_ROOT . 'src/base/base.php';
  require PROJECT_ROOT . 'src/db/db.php';
  require PROJECT_ROOT . 'src/session/session.php';
  require PROJECT_ROOT . 'src/logger/logger.php';
  require PROJECT_ROOT . 'src/metrics/metrics.php';

$tic= time();
$namespace= $argv[1];
$method= "\\$namespace\\".$argv[2];
$lib= PROJECT_ROOT . "src/$namespace/$namespace.php";
require_once $lib ;

if(isset($argv[3]))
  $args= $argv[3];

if ( function_exists( $method) ){
  try{
    if(isset($args))
      $result= $method($args);
    else
      $result= $method();

    if($result)//TODO make option
      var_dump($result);

  }catch( \Exception $e){
    echo red($e->getMessage());
  }

  echo green("\n\nOK, done in ".(time()-$tic)." s\n\n");
}else
    echo(red($method . " no existe en $lib. Comprueba el namespace y el nombre del método."));

?>
