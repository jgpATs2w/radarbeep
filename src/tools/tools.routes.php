<?php


$app->get('/help', function ($request, $response, $args) {
    $response->write("I need somebody...");
    return $response;

});

$app->get('/config', function ($request, $response, $args) {

  $defined= get_defined_constants(true);

  prettyprint_r($defined['user']);

  echo "post_max_size: " . ini_get( 'post_max_size' ) . " <br>";
  echo "upload_max_filesize: " . ini_get( 'upload_max_filesize' ) . " <br>";
  echo "memory_limit: " . ini_get( 'memory_limit' ) . " <br>";
  echo "allow_url_fopen: " . ini_get( 'allow_url_fopen' ) . PHP_EOL;

});

$app->get('/info', function ($request, $response, $args) {
  phpinfo();
});
