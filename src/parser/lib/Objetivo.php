<?php
namespace parser;

class Objetivo extends Template{

  public static function make( $string ){
  	$re = '/X\ ?(\d+)\.(.+\.?)/m';

  	if( preg_match($re, $string, $match) ){

  		$code = $match[1];
  		$data = $match[2];

  		$dir = self::getDir0( "fuentes" );
  		\mkdirr( $dir, 0777, true );

  		self::put($dir . sprintf("%02d", $code) . "_0obj.html", self::tpl( $data ) );

  		Parser::$Count['objetivos']++;

  	}else
  		\printJson( 0, "error leyendo objetivo ( $string ) ", $string );

  }
}

?>
