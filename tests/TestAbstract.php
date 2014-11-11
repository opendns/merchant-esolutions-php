<?php

abstract class TestAbstract Extends \PHPUnit_Framework_TestCase
{
    protected $className;
    protected $requestData = array();
    protected $responseBodyString = 'success=1&foo=bar';
    protected $responseHeaders = array(
        'X-Cool-Response' => 'Wizard',
    );

    public function setUp()
    {
        $this->mockRequest = new \Guzzle\Plugin\Mock\MockPlugin();
        $body = \Guzzle\Http\EntityBody::fromString($this->responseBodyString);
        $this->mockRequest->addResponse(new Guzzle\Http\Message\Response(200, $this->responseHeaders, $body));
        $this->client = $this->getClientInstance();
        $this->client->addClientSubscriber($this->mockRequest);
    }

    public function getClientInstance($className = null)
    {
        $className = $className ?: $this->className;
        return $className::factory($className::ENV_TEST);
    }

    public function executeClient()
    {
        $this->client->execute();
        return $this->getLastRequest();
    }

    public function getLastRequest()
    {
        $sentRequest = current($this->mockRequest->getReceivedRequests());
        $method = $sentRequest->getMethod();
        if ($method === 'GET' || $method === 'HEAD') {
            $this->requestData = $sentRequest->getQuery()->toArray();
        } else {
            parse_str($sentRequest->getBody(), $this->requestData);
        }

        return $this->requestData;
    }

}
