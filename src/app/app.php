<?php

namespace app;

function read($descripcion='', $longitud=0, $latitud=0, $distancia='10'){
  $distancia= +$distancia;
  $delta_lon= [$longitud-6371*cos(deg2rad($distancia)),$longitud+6371*cos(deg2rad($distancia))];
  $delta_lat= [$latitud-6371*sin(deg2rad($distancia)),$latitud+6371*sin(deg2rad($distancia))];

  $q= "SELECT * FROM radares WHERE descripcion LIKE '%$descripcion%' AND longitud BETWEEN {$delta_lon[0]} AND {$delta_lon[1]} AND latitud BETWEEN {$delta_lat[0]} AND {$delta_lat[1]}";
  \db\query($q);

  $radares= \db\get_array_full();

  return $radares;
}

function parseDgt($url){
  $radares= [];
  //http://www.dgt.es/images/Tramos_INVIVE_17102017.xml
  $client = new \GuzzleHttp\Client();
  $res = $client->request('GET', $url );

  $status= $res->getStatusCode();

  $xml= (string) $res->getBody();
  //TODO parse fecha próxima actualización

  libxml_use_internal_errors(true);
  $dom= new \DOMDocument();
  $dom->loadXML( $xml );

  $carreterasNodeList= $dom->getElementsByTagName('CARRETERA');
  $denominacion= "";
  foreach($carreterasNodeList as $carreteraNode){
    foreach($carreteraNode->childNodes as $carreteraChildNode){
      if(!isset($carreteraChildNode->tagName)) continue;//text node
      $tagName= strtolower($carreteraChildNode->tagName);
      switch($tagName){
        case "denominacion":
          $denominacion= $carreteraChildNode->nodeValue;
          break;
        case "radar":

          foreach( $carreteraChildNode->childNodes as $radarPropertyNode ){
            if(!isset($radarPropertyNode->tagName)) continue;//text node
            $tagName= strtolower($radarPropertyNode->tagName);
            if($tagName== "sentido"){
              $radar[$tagName]= $radarPropertyNode->nodeValue;

            }else{
              $radar= ['descripcion'=> $denominacion." ".$tagName];
              foreach($radarPropertyNode->childNodes as $childNode){
                if(!isset($childNode->tagName)) continue;//text node
                $radar[strtolower($childNode->tagName)]= $childNode->nodeValue;
              }
              array_push($radares, $radar);
            }
          }
          break;
        default:
          throw new \Exception("unknown tag inside CARRETERA $tagName");
      }

    }
  }

  \db\prepare("INSERT IGNORE INTO radares (descripcion, latitud, longitud, origen) VALUES (?,?,?,?)");
  $loadToDB= function($radar) use ($url){
    \db\execute([$radar['descripcion'], $radar['latitud'], $radar['longitud'], $url]);
  };

  array_map($loadToDB, $radares);
  return count($radares);
}
?>
