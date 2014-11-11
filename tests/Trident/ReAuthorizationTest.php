<?php

class Trident_ReAuthorizationTest Extends TestAbstract
{
    protected $className = 'OpenDNS\MES\Trident\ReAuthorization';

    public function testReAuthorizationRequest()
    {
        $this->client->setAmount('100');
        $this->client->setTransactionId('1234567');
        $this->executeClient();

        $this->assertEquals('J', $this->requestData['transaction_type']);
        $this->assertEquals('100', $this->requestData['transaction_amount']);
        $this->assertEquals('1234567', $this->requestData['transaction_id']);
    }
}
