<?php

namespace logger;
require_once 'Logger.class.php';

function error( $tag, $message='' ){

	return Logger::error( $tag, $message );
}

function info( $tag, $message='' ){

	return Logger::info( $tag, $message );
}
function debug( $tag, $message='' ){

	if( ! DEBUG )
		return;

	return Logger::debug( $tag, $message );
}

/*
*  Only use when db is not safe
*/
function log2file( $message ){
	\createDir( LOGDIR );

	 if(strlen($message)>LOG_TRUNCATE)
	 	$message = substr($message, 0, LOG_TRUNCATE);

   $message = date( 'c') . " " . $message;

	 if(is_writable(FILE_APPEND))
   	file_put_contents( LOGDIR . "errors." . date( "Y-m-d" ) . ".log", "$message\n" , FILE_APPEND );
}

?>
