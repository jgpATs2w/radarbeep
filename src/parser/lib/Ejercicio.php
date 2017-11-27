<?php
namespace parser;

class Ejercicio extends Template{
	static $code = "";
	static $enunciado = "";
	static $resultado = "";
	static $formulasEnunciado = 0;
	static $formulasResultado = 0;

	static function init( $text ){
		self::$code = self::getCode( $text );
		self::$enunciado = "";
		self::$resultado = "";
		self::$formulasEnunciado = 0;
		self::$formulasResultado = 0;
	}
	static function addResultado( $string ){

    if( self::checkImgObject($string))
      Parser::$Count['formulas']++;

			self::$resultado .= "$string";

	}
	static function addEnunciado( $string ){

    if( self::checkImgObject($string))
      Parser::$Count['formulas']++;

		self::$enunciado .= "$string";

	}

	static function getEnunciado(){
		return self::$enunciado;
	}

	static function getResultado(){
		return self::$resultado;
	}

	static function save(){
		$code = str_replace(".", "", self::$code );

    $tipo = Parser::$tipo;

		$tipo_enu = $tipo."e";
        $tipo_res = $tipo."r";

		$ftype = sprintf( "%02d", Parser::$unidad );
		if( $tipo ==  "p" || $tipo == "f" ){
			$unidad = $tipo;
			$ftype = "0$tipo";
		}

		$fenunciados0 = self::getDir0( "ejercicios" ) . "enunciados/" . $tipo_enu . $ftype . $code . ".html";
		$fresultados0 = self::getDir0( "ejercicios" ) . "resultados/" . $tipo_res . $ftype . $code . ".html";

		self::$enunciado= symbol_sanitize_string(self::$enunciado);
		self::$resultado= symbol_sanitize_string(self::$resultado);

		file_put_contents( $fenunciados0, self::tpl( self::$enunciado, true ) );

		file_put_contents( $fresultados0, self::tpl( self::$enunciado . self::$resultado, true ) );

		$result= exec( BASE.'bin/./repair_math_symbols.sh '.$fenunciados0.' 2>&1' );
		$result= exec( BASE.'bin/./repair_math_symbols.sh '.$fresultados0.' 2>&1' );

		self::makeWritable($fenunciados0);
		self::makeWritable($fresultados0);

		Parser::$Count['ejercicios']++;

	}

	private static function makeWritable($file){
		exec("chmod go+w $file");
	}

	//replaces old format (rtf) by extracted new format
  private static function getCode( $text ){
  	$code = $text;
  	if( preg_match('/^E.+?([\da-f]+)\.rtf\.-/', $text) )
  		$code = preg_replace('/^E.+?([\da-f]{3,3})\.rtf\.-/', '$1', $text );

			//replaces old format (rtf) by extracted new format
  	return $code;
  }
  private static function checkImgObject( $text ){

    return preg_match('/<img .+ name="Object/', $text);
  }
}

?>
