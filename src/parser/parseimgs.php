<?php
namespace parseimgs;

if( !isset( $_POST['html']))
	_theend( 0, "falta html en post" , null );

global $codigo;
$html = $_POST['html'];
$codigo = $_POST['codigo'];

//$html = str_replace(array("\n", "\r"), ' ', $html);
//$html = str_replace('&', '&amp;', $html);
//$html = str_replace(array('_lt_', '_gt_', '_amp_'), array('&lt;', '&gt;', '&amp;'), $html);

//required to load utf-8
$html = '<!DOCTYPE html>
			<head lang="es">
				<meta charset="UTF-8"/>
			</head>
			<body>' . $html . '</body>';

\logger\debug( $codigo, "purified html: $html" );

// Load DOM
$dom = new \DOMDocument();
$dom->preserveWhiteSpace = false;
$dom->substituteEntities = false;
//libxml_use_internal_errors(true);
if( ! $dom->loadHTML($html) ){
	_theend( 0, "no se ha podido cargar html: $html" , null );
}
libxml_use_internal_errors(false);

$nodes = $dom->getElementsByTagName('img');

foreach( $nodes as $imgNode ){
	parseImage( $imgNode );
}

_theend( 1, "OK", $dom->saveHTML( $dom->getElementsByTagName('body')->item(0) ) );

function parseImage( $node ){global $codigo;

	$tmpdir = TMP . "img/$codigo/";

	$src = $node->getAttribute( 'src');

	\logger\logto( $codigo, "processing $src" );

	if( strpos( $src, "data:image" ) !== false ){

		\createDir( $tmpdir ) ;

		$match = array();
		preg_match( '/data:image\/(\w+);base64,(.+)/', $src, $match );

		$src = $imgFile =  $tmpdir . uniqid() . "." . $match[1];

		$ifp = fopen( $imgFile, "wb");

	    fwrite($ifp, base64_decode( $match[2] ) );
	    fclose($ifp);

	}

	if( is_file( $src ) ){

        $node->setAttribute( 'src', BASEURL . "tmp/img/$codigo/" . basename( $src ) );

		\logger\debug( $codigo, "imágenes exportadas, generated $src" );
	}else{

		\logger\error( $codigo, "$src image not found, image not included" );


	}

    return true;
}

function _theend( $result, $msg, $return ){global $codigo;
	if( $result == 0 )
		\logger\error( $codigo, $msg );

	echo printJson( $result, $msg, $return );

}
?>
