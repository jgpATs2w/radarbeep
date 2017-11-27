<?php
namespace parser;

class Criterio extends Template{

  public static function make( $string ){
    $re = '/(\d+\.[\da-z])\.? ?(.+\.?)/';

  	if ( preg_match($re, $string, $match) ) {

  		$codeArray = explode(".",$match[1]);

      $subcodigo= $codeArray[1];
      if(!is_numeric($subcodigo)){//never used, the letters are in ejercicio
        $letters= array('a','b','c','d','e');
        //$subcodigo= 10+array_search($subcodigo, $letters);
      }

  		$code = sprintf("%02d", $codeArray[0]) . "_" . $subcodigo;
  		$data = $match[2];

  		$dir = self::getDir0( "fuentes" );

  		\createDir( $dir );

  		self::put($dir . $code . "crit.html", self::tpl( $data ) );

  		parser::$Count['criterios']++;
  	}else
  		printJson( 0, "error leyendo criterio ( $string )", $string );

  }
}

?>
