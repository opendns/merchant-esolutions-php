<?php

class ResponseTest Extends TestAbstract
{
    // Using capture for response testing
    protected $className = 'OpenDNS\MES\Trident\Capture';
    protected $responseBodyString = 'success=1&transaction_id=abcdefg123456';

    public function testStreamResourceIsPhpResource()
    {
        $response = $this->client->execute();
        $stream = $response->getResponseBodyStream();
        $this->assertInternalType('resource', $stream);
        $body = fread($stream, 9999);
        $this->assertEquals($this->responseBodyString, $body);
    }

    public function testJsonMethodReturnsValidJson()
    {
        $response = $this->client->execute();
        $json = $response->json();
        $parsed = json_decode($json);
        $this->assertEquals(JSON_ERROR_NONE, json_last_error());
        $this->assertEquals('abcdefg123456', $parsed->transaction_id);
    }

    public function testArrayAccessibility()
    {
        $response = $this->client->execute();
        $this->assertArrayHasKey('transaction_id', $response);
        $this->assertEquals('abcdefg123456', $response['transaction_id']);
    }
}
