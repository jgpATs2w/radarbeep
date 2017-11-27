<?php

class IntegrationTest extends \AppTestCase
{
    public function test_home(){

      $client = new GuzzleHttp\Client();
      $res = $client->request('GET', 'http://localhost/anaya-geval/api/v1/evaluaciones' );

      $status= $res->getStatusCode();

      $json= json_encode((string)$res->getBody());

      $this->assertSame($status,200);
    }

}
