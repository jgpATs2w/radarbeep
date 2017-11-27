<?php
require 'src/config.php';

$app = new Slim\App($settings);

require 'src/dependencies.php';
include 'src/routes.php';

$app->add(function ($request, $response, $next) {

	$response = $next($request, $response);

	return $response;
});

$app->run();
