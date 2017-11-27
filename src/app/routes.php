<?php
namespace app;
require SRC . 'tools/tools.php';

$app->get('/radares.html', function ($request, $response, $args) {
  return $response->write(file_get_contents(SRC.'map/map.html'));
});

$app->get('/radares.json', function ($request, $response, $args) {
  extract($request->getQueryParams());
  $descripcion= isset($descripcion)? $descripcion:'';
  $longitud= isset($denominacion)? $denominacion:'-3.5170123';
  $latitud= isset($denominacion)? $denominacion:'40.3510851';
  $distancia= isset($distancia)? $distancia: '10';

  $radares= read($descripcion, $longitud, $latitud, $distancia);

  return $response->withJson($radares);
});

$app->post('/dgt', function ($request, $response, $args) {
  $nRadares= parseDgt('http://localhost/radarbeep/tests/assets/Tramos_INVIVE_17102017.xml');

  return $response->write("procesados $nRadares radares");
});
?>
