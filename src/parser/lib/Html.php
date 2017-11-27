<?php
namespace parser;

class Html{

  static $doc = null;
  static $body = null;

  public static function load( $html ){

//    $html= self::cleanHtml($html);
    self::$doc = new \DOMDocument ( );
    self::$doc->substituteEntities = false;

    libxml_use_internal_errors(true);
    self::$doc->loadHTML( $html );
    libxml_use_internal_errors(false);

    self::exportImgs();

    self::$body = self::$doc->getElementsByTagName('body') ;

  }
  private static function cleanHtml($html){

    $html= preg_replace("/<a name=\"_GoBack1\".*?>/", "", $html);
    $html= preg_replace("/<p.*><br\/><\/p>/", "", $html);//FIXME doesn't remove

    return $html;
  }
  public static function getHtml( $node ){
    return self::$doc->saveXML($node);
  }

  public  static function getNodesToParse(){
    $bodyChildNodes= self::$body->item(0)->childNodes;

    $xpath = new \DOMXpath(self::$doc);
    $divSection1= $xpath->query('//div[contains(@class,"Section1")]');

    if($divSection1->length>0)
      return $divSection1->item(0)->childNodes;
    else
      return self::$body->item(0)->childNodes;
  }

  public  static function exportImgs(){
    $nodes = self::$doc->getElementsByTagName('img');

    foreach( $nodes as $i => $imgNode ){
    	self::exportImg( $imgNode, $i+1 );
    }
  }

  private static function exportImg( $node, $index ){

    $codigo = isset(Parser::$codigo) ? Parser::$codigo : '';

    $dir = Parser::$imgDir;

    \session\put( 'imgDir', $dir );//TODO remove!!

    $webdir = str_replace( STORE, STORE_URL, $dir );
    $webdir = str_replace( IMGDIR, IMGDIR_URL, $webdir );

  	$src = $node->getAttribute( 'src');
    if( $node->hasAttribute( 'name' ) )
      $name = strtolower( $node->getAttribute( 'name') );
    else
      $name = uniqid();

  	if( strpos( $src, "data:image" ) === false ){
      if(strpos($src, "http://") === false)
          $src= $webdir.basename($src);
    }else{
  		$match = array();
  		preg_match( '/data:image\/(\w+);base64,(.+)/', $src, $match );

  		$src = $imgFile =  $dir . $name . "." . $match[1];

  		$ifp = fopen( $imgFile, "wb");
      if($ifp){
  	    fwrite($ifp, base64_decode( $match[2] ) );
  	    fclose($ifp);
      }else
        throw new \Exception("could not write image to file '$imgFile' ");
  	}

  	if( is_file( $src ) ){

      $node->setAttribute( 'src', $webdir . basename( $src ) );
      //FIX: no se encontraban imágenes en docx cuando hay wmf y pngs
      $node->setAttribute( 'data-media', "image$index" );

  	}else
  		\logger\error( $codigo, "v2.parser.Html#$src image not found, image not included" );

      return true;
  }
}

?>
