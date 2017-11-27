<?php
namespace parser;

class Actividad{
	private static $initialized= false;
	static $id= null;//TODO privatize
	static $origin = '';
	static $keywords = '';
	static $enunciado = '';
	static $solucion = '';
	static $formulasEnunciado = 0;
	static $formulasResultado = 0;
	static $tags= array();

	static function init($prefix="", $file=false, $tags=false){
		self::$initialized= true;
		self::$origin= $file? basename($file) : 'doc';
		self::$enunciado = '';
		self::$solucion = '';
		self::$formulasEnunciado = 0;
		self::$formulasResultado = 0;
		self::$tags= $tags? $tags : array();

		return true;
	}

	static function isInitialized(){
		return self::$initialized;
	}

	static function addSolucion( $string ){

    if( self::checkImgObject($string))
      Parser::$Count['formulas']++;

			self::$solucion .= "$string";

	}

	static function addEnunciado( $string ){

    if( self::checkImgObject($string))
      Parser::$Count['formulas']++;

		self::$enunciado .= "$string";

	}

	static function addTags( $tags , $prefix ){
		foreach( explode(';', $tags) as $tag){
			if($tag != '')
				self::addTag($prefix.'/'.trim($tag, " y"));
		}
	}

	static function addTag( $tag ){
		$tag= strtolower($tag);
		if(array_search($tag, self::$tags) === false){
				array_push(self::$tags, $tag );
	      Parser::$Count['etiquetas']++;
		}
	}

	static function setKeywords( $keywords ){
		self::$keywords= $keywords;
	}

	static function setId( $id ){
		self::$id= $id;
	}

	static function getEnunciado(){
		return self::$enunciado;
	}

	static function getResultado(){
		return self::$solucion;
	}
	static function getTags(){
		return self::$tags;
	}

	static function save(){
		if(self::$enunciado=="") return false;

		if(is_null(self::$id))
			\actividades\create(self::toArray());
		else
			\actividades\update(self::$id, self::toArray());

		Parser::$Count['actividades']++;

		//reset
		self::$initialized= false;
		return true;
	}

	private static function makeWritable($file){
		exec("chmod go+w $file");
	}

  private static function checkImgObject( $text ){

    return preg_match('/<img .+ name="Object/', $text);
  }

	static function toArray(){
		return [
			'id' => self::$id,
			'origin' => self::$origin,
			'estado' => 'nueva',
			'keywords' => self::$keywords,
			'tags' => self::$tags,
			'enunciado'=> self::$enunciado,
			'solucion'=> self::$solucion
		];
	}
}

?>
