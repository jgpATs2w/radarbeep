<?php

class AppTest extends \AppTestCase
{

  public function test_processZip(){

    $uploadedFile= STORE."1/upload/U06_mathml_archivos.zip";
    copy(PROJECT_ROOT.'/tests/assets/U06_mathml_archivos.zip', $uploadedFile);

    $result= \app\processZip('1', $uploadedFile, '1', 'mec', 'i', '6');

    $this->assertTrue($result, "las imágenes no se han descomprimido");
  }
}
?>
