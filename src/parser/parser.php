<?php
namespace parser;

require 'lib/Parser.php';

require 'lib/Template.php';
require 'lib/Ejercicio.php';
require 'lib/Actividad.php';
require 'lib/Objetivo.php';
require 'lib/Criterio.php';
require 'lib/Html.php';

require 'lib/symbols.php';

function main( $args ){

	Parser::fromHtmlToStore( $args );

	\logger\debug( "parser", "FIN " . Parser::$message );

	return true;
}

function parseHtmlToActividades($file, $prefix, $tags=false){

	return Parser::fromHtmlToActividades($file, $prefix, $tags);
}

?>
