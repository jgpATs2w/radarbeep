<?php
namespace parser;
include SRC . 'parser/assets/chartable.php';

function symbol_sanitize_string($string) {

	$string = preg_replace( '/charset=iso-8859-1/', 'charset=utf-8', $string );

	//replace font symbols alone
	$string =  preg_replace_callback('/&#(61\d+?);/i', '\parser\symbol_alone2utf8', $string);

	//replace symbols represented by letters (i.e. q for rational numbers )
	$string =  preg_replace_callback('/(<font face="Symbol.+>)(\w)(.+\/font>)/i', '\parser\symbolLetters2utf8', $string);

	$fonts="[Symbol|MT]";
	$regex= '/(<font face="'.$fonts.'.+>)([^a-zA-Z\d\s<>=",-]+)(.+\/font>)/u';
	$string =  preg_replace_callback(
									$regex,
									'\parser\fontSymbol',
									$string
						);

	return $string;

}

function symbol_alone2utf8( $match ){

	$utf8 = symboldec2utf8hex( $match[1] );//echo $utf8;

	return $utf8;
}

function symbolLetters2utf8 ( $match ) { global $Letters;
	$letter = $match[2];

	if( array_key_exists( $letter, $Letters ) ){
		$code = $Letters[ $letter ];
		if( strlen( $code ) <= 3 )
			$code = '0' . $code;

		$char = json_decode( '"\u' . $code . '"');

		\metrics\increase("letter_".$letter."_".$char);

		return  $match[1].$char.$match[3];
	}else{
		\metrics\increase("letter_".$letter."_unknown");
		\logger\error( "symbols", "symbolLetters2utf8: letter not found $letter<br>" );
		return $match[0];
	}
}

function fontSymbol ( $match ) { global $_Symbol, $_Symbol_untested;

	$char = $match[2];//TODO convert multiple characters
	$ord= \parser\ordutf8($char);

	if(array_key_exists($ord, $_Symbol)){
		$hex= $_Symbol[$ord];
		\metrics\increase("symbol_$hex");

	}else if(array_key_exists($ord, $_Symbol_untested)){
		$hex= $_Symbol_untested[$ord];
		\metrics\increase("symbol_untested_$hex");

	}else{
		\metrics\increase("symbol_unknown_$char");
		return $match[0];
	}
	if(strlen($hex)<4)
		$hex='0'.$hex;

	$unicode = json_decode( '"\u' . $hex . '"');

	$vector= "'$char','$ord','$hex','$unicode'";
	\metrics\increase($vector);
	if($unicode=='')
		\metrics\increase("symbol_empty_$char");

	return $match[1].$unicode.$match[3];
}

//from user notes of http://php.net/manual/es/function.ord.php
function ordutf8($string, &$offset=0) {
    $code = ord(substr($string, $offset,1));
    if ($code >= 128) {        //otherwise 0xxxxxxx
        if ($code < 224) $bytesnumber = 2;                //110xxxxx
        else if ($code < 240) $bytesnumber = 3;        //1110xxxx
        else if ($code < 248) $bytesnumber = 4;    //11110xxx
        $codetemp = $code - 192 - ($bytesnumber > 2 ? 32 : 0) - ($bytesnumber > 3 ? 16 : 0);
        for ($i = 2; $i <= $bytesnumber; $i++) {
            $offset ++;
            $code2 = ord(substr($string, $offset, 1)) - 128;        //10xxxxxx
            $codetemp = $codetemp*64 + $code2;
        }
        $code = $codetemp;
    }
    $offset += 1;
    if ($offset >= strlen($string)) $offset = -1;
    return $code;
}

function symboldec2utf8hex( $decimal ) { global $_Symbol,$_Symbol_untested;

	$key = $decimal;
	if( array_key_exists( $key, $_Symbol ) ){
		$code = $_Symbol[ $key ];
		if( strlen( $code ) <= 3 )
			$code = '0' . $code;
		$char = json_decode( '"\u' . $code . '"');

		\metrics\increase( "char_tested_" . $decimal );

		return $char;
	}else{
		\logger\error( "symbols", "caracter no encontrado ($decimal, &#$decimal;), probando no testados" );

		if( array_key_exists( $key, $_Symbol_untested ) ){
			$code = $_Symbol_untested[ $key ];
			if( strlen( $code ) <= 3 )
				$code = '0' . $code;
			$char = json_decode( '"\u' . $code . '"');

			\metrics\increase( "char_untested_" . $decimal );
			\metrics\increase( "(&#$decimal;,$code, $char )" );

			return $char;
		}else{
			\logger\error( "symbols", "nada que hacer con $decimal" );
			\metrics\increase( "symbol unknown" );
			\metrics\increase( "symbol unknown:&#$decimal;" );
			return "&#$decimal;";
		}
	}
}


?>
