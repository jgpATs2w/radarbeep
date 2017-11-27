<?php

require 'app/routes.php';

$app->get('/', function ($request, $response, $args) {
    return $response->withRedirect('help');
});
