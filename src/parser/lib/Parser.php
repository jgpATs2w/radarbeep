<?php

namespace parser;

class Parser{
	static $codigo = null;
		static $nombre = null;
		static $curso = null;
		static $region = null;
		static $tipo = null;
		static $numero = null;
		static $unidad = null;
		static $solucion_str = null;
		static $imgDir = null;
		static $ejPattern = null;
		static $Count = null;

	  static $message = "";

	static function fromHtmlToStore( $args ){

    self::init( $args );

		if(isset($args['file'])){
    	$file= $args['file'];
			if(!is_file($file))
				$file= STORE.self::$codigo."/upload/$file";
		}else{
			$outdir = TMP . self::$codigo . "/out/";
	    $files = glob( "$outdir*.html" );

	    if( count($files) <= 0 )
	      return self::returnError( 'no hay archivos que procesar' );

	    if( count($files) > 1 )
	      return self::returnError( 'solo se puede procesar un archivo' );

			$file= $files[0];
		}

		self::parseFileToStore($file);

  }

	static function fromHtmlToActividades($file, $prefix, $tags){
		self::$solucion_str= "Soluci";
		self::$imgDir= IMGDIR;
		if(!is_dir(self::$imgDir))
			throw new \Exception("no existe el directorio contenedor de imagenes ".self::$imgDir );

    self::$Count = array(
      'objetivos' => 0,
      'criterios' => 0,
      'etiquetas' => 0,
      'ejercicios' => 0,
      'actividades' => 0,
      'formulas' => 0
    );

		return self::parseFileToActividades($file, $prefix, $tags);
	}

  static private function init( $args ){
    self::$codigo = $args['codigo'];
	    self::$nombre = isset($array['nombre'])? $array['nombre']:'';
	    self::$curso = $args[ 'curso' ];
	    self::$region = $args[ 'region' ];
	    self::$tipo = $args[ 'tipo' ];
	    self::$numero = $args[ 'numero' ];
	    self::$unidad = $args[ 'numero' ];
	    self::$solucion_str = (isset($array['nombre']) && strlen( $args[ 'solucion_str' ] ) > 2) ? $args[ 'solucion_str' ] : "Soluci";
			self::$imgDir= Template::getDir0('ejercicios') . "img/";

    self::$ejPattern = '/[\da-z]\.[\da-z]\.\d/';
    self::$Count = array(
      'objetivos' => 0,
      'criterios' => 0,
      'ejercicios' => 0,
      'formulas' => 0
    );

    self:: skeleton();
  }

  static private function parseFileToStore($file){

      $fileContents = file_get_contents( $file );

			Html::load( $fileContents );

      $state = 0;
      $state1_reached = false;
      $state2_reached = false;

			$nodes= Html::getNodesToParse();


      foreach( $nodes as $node ){

        $text = self::clean($node->textContent);//$text = _clean($node->nodeValue);

        if( $state == 0 ){//TODO optimize with more probable option here

          if ( preg_match('/' . PARSE_OBJETIVO_REGEX .  '/', $text ) )
            Objetivo::make( $text );

          else if( preg_match('/' . PARSE_CRITERIO_REGEX .  '/', $text) )

            Criterio::make( $text );

          else if ( preg_match( self::$ejPattern, $text) || preg_match('/^E.+?([\da-z]+)\.rtf\.-/', $text) ){
            $state = 1;

            Ejercicio::init( $text );

          }

        }else{

          if( preg_match( self::$ejPattern, $text) || preg_match('/^E.+?([\da-z]+)\.rtf\.-/', $text) ){//ejercicio

            Ejercicio::save();
            Ejercicio::init( $text );
            $state = 1;
            $state1_reached = true;

          }else if( preg_match( "/^" . self::$solucion_str . "/", $text) ){//resultado

            Ejercicio::addResultado( $text );

            $state2_reached = true;
            $state = 2;
          }
          else if( $state == 1 ){
            $html = Html::getHtml( $node );

            Ejercicio::addEnunciado( $html );
          }
          else if( $state == 2 ){

						$html = Html::getHtml( $node );

            if( ! preg_match('/\*@\*/', $text) )
              Ejercicio::addResultado( $html );
          }

        }
      }

      if( $state1_reached )

        Ejercicio::save();

      else
        return self::returnError( 'formato incorrecto: no se han encontrado ejercicios' );

      if( ! $state2_reached )
        self::$message = 'Advertencia: no se han encontrado soluciones';

    $Count = self::$Count;
    if( self::$message == "" )
      self::$message = "OK. Procesados correctamente {$Count['objetivos']} " .
                                                PARSE_OBJETIVO_STR . ", {$Count['criterios']} " .
                                                PARSE_CRITERIO_STR. " y {$Count['ejercicios']} ejercicios";

		if( $Count['formulas'] > 0 )
			self::$message .= '. <p style="color:blue">Se han encontrado '.$Count['formulas'].' imágenes con ecuaciones, se deberían <a href="#" onclick="$P.open(\'images\')" class="small">revisar</a></p>';

    return true;
  }

	static private function parseFileToActividades($file, $prefix, $tags){
			require_once SRC . 'actividades/actividades.php';
			require_once SRC . 'tags/tags.php';

      $fileContents = file_get_contents( $file );

			Html::load( $fileContents );

			/*
			* 0: pre-enunciado
			* 1: enunciados
			* 2: post-enunciado
			* 3: pre-solucion
			* 4: solucion
			* 5: post-solucion
			*
			*
			*/
			$state= 0;//0: enunciado, 1: solucion | etiquetas | keywords | *@*
								//0: pre-enunciado
								//

			$nodes= Html::getNodesToParse();
			$htmlBuffer= '';

      foreach( $nodes as $node ){
				set_time_limit(600);
        $text = self::clean($node->textContent);
				$matches= array();

				if( $state== 0 ){
					if(!Actividad::isInitialized())
						Actividad::init($prefix, $file, $tags);

					if( preg_match( "/^Soluci/", $text) ){
						$state= 1;
						continue;
					}elseif($text!=''){
						Actividad::addEnunciado( Html::getHtml( $node ) );
					}

				}else if( $state == 1 ){
					//TODO optimize (measure times)
					if( preg_match( "/^Competencias:(.+)/i", $text, $matches) ){
						Actividad::addTags( $matches[1], 'competencias' );

					}elseif( preg_match( "/^Dificultad:(.+)/i", $text, $matches) ){
						Actividad::addTags( $matches[1], 'dificultad' );

					}elseif( preg_match( "/^Idioma:(.+)/i", $text, $matches) ){
						Actividad::addTags( $matches[1], 'idioma' );

					}elseif( preg_match( "/^Ccaa:(.+)/i", $text, $matches) ){
						Actividad::addTags( $matches[1], 'ccaa' );

					}elseif( preg_match( "/^Contenido:(.+)/i", $text, $matches) ){
						Actividad::addTags( $matches[1], 'contenido' );

					}elseif( preg_match( "/^Nivel:(.+)/i", $text, $matches) ){
						Actividad::addTags( $matches[1], 'nivel' );

					}elseif( preg_match( "/^Palabras\Wclave:(.+)/i", $text, $matches) ){
						Actividad::setKeywords( $matches[1] );

					}elseif( preg_match( "/^Id:(.+)/i", $text, $matches) ){
						Actividad::setId( trim($matches[1]) );

					}elseif( preg_match('/\*@\*/', $text) ){
							Actividad::save();
							$state= 0;
							continue;
					}elseif( preg_match('/^#/', $text) ){//comentarios
							continue;
					}else
						Actividad::addSolucion( Html::getHtml( $node ) );

				}
      }

      if( Actividad::isInitialized() )
        Actividad::save();

    return self::$Count;
  }


  private static function skeleton(){
    $root = STORE . self::$codigo . '/';

  	if( ! is_dir( $root . '_01intro' ) )
  		cpr( TPL . "evaluacion/", $root );

  	self::skeletonInit( Template::getDir0( "ejercicios" ) . "enunciados" );
  	self::skeletonInit( Template::getDir0( "ejercicios" ) . "resultados" );
  	self::skeletonInit( Template::getDir0( "ejercicios" ) . "img" );
  	self::skeletonInit( Template::getDir0( "fuentes" ) );

  }

  private static function skeletonInit( $dir ){

  	if( is_dir( $dir ) )
  		exec("rm $dir/* > /dev/null 2>&1");
  	else
  		\createDir( $dir );
  }

  private static function nonempty( $html ) {

  	if ( preg_match( '/<br\/\><\/p\>$/', $html ) )
  		return false;

  	if ( $html == "" || $html == " " )
  		return false;

  	return true;
  }

  private static function clean( $string ){
  	return trim( str_replace( "\n", " ", $string ) );
  }

  private static function logDebug( $msg ){
    \logger\debug( self::$codigo, $msg );
  }

  private static function logInfo( $msg ){
    \logger\debug( self::$codigo, $msg );
  }

  private static function logError( $msg ){
    \logger\debug( self::$codigo, $msg );
  }

  private static function returnError( $msg ){
    self::logError( $msg );

    self::$message = $msg;

    return false;

  }
}
?>
