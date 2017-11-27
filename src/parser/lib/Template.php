<?php
namespace parser;

class Template{

  static function tpl( $string, $ejercicio = false ){

  	return self::tplHeader( $ejercicio ) .  $string . self::tplFooter();
  }

  private static function tplHeader( $ejercicio ){

  	$header = '<!DOCTYPE html>' .
  		'<head lang="es">' .
  			'<meta charset="UTF-8"/>' .
  		'</head>'.
  		'<body>';

  	if( $ejercicio )
  		$header .= '<p><strong><em><u>Ejercicio n&ordm; @.-</u></em></strong></p>';

  	return $header;

  }

  private static function tplFooter(){
  	return '<br/></body></html>';
  }

  static function getDir0( $parent ){

    $root = STORE . Parser::$codigo . '/';
    $tipo = Parser::$tipo;
    $curso = Parser::$curso;
    $region = Parser::$region;

    if( $tipo == "f" || $tipo == "p")
      $ucode = "0" . $tipo;
    else
      $ucode = sprintf( "%02d", Parser::$unidad );

    $tipocode = $tipo;

    if( $parent == "ejercicios" )

      return $root . "_xxEjerciciosHTM/$curso/$region/$tipocode/$ucode/";

    else{

      $conv = array(
        "i" => "individual",
        "g" => "general",
        "f" => "final",
        "p" => "inicial"
      );

      if( $tipo == "i" )
        $ucode = "u" . Parser::$unidad;
      else if( $tipo == "g" )
        $ucode = "b" . Parser::$unidad;
      else if( $tipo == "f" || $tipo == "p" )
        $ucode = $tipo;

      return $root . "_xxFuentesHTM/$curso/$region/{$conv[$tipo]}/$ucode/";
    }
  }

  static function put( $file, $data ){
  	$html = "<p style='font:Arial;font-size:10pt'>" . $data . "</p>";

  	file_put_contents( $file, $html );
  }
}

?>
