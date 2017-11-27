<?php

class IntegrationProccessTest extends \AppTestCase
{

  public function test_integration_proccess_zip(){

    if(!is_file(STORE.'1/upload/U06_mathml_archivos.zip'))
      copy(PROJECT_ROOT.'/tests/assets/U06_mathml_archivos.zip', STORE.'1/upload/U06_mathml_archivos.zip');

    $client = new GuzzleHttp\Client();
    $res = $client->request('POST',  'http://localhost/anaya-geval/api/v1/evaluaciones/1?method=processZip&tipo=i&numero=6&file=U06_mathml_archivos.zip&curso=1&region=mec', []);

    $status= $res->getStatusCode();

    $json= json_encode((string)$res->getBody());

    $this->assertSame($status,200);

  }

}

?>
