<?php
namespace logger;

class Logger{

	private static function log($tag, $message, $level){

		$q= "insert into logger (logtime, tag, level, message) values (NOW(), ?,?,?)";

		\db\prepare($q);
    \db\execute(array($tag, $level, $message));
	}

	public static function error( $tag, $message ){

		return self::log($tag,$message,'error');
	}

	public static function debug( $tag, $message ){

		return self::log($tag,$message,'debug');
	}
	public static function info( $tag, $message ){

		return self::log($tag,$message,'info');
	}
}
?>
