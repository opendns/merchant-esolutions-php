<?php

class Trident_VoidTest Extends TestAbstract
{
    protected $className = 'OpenDNS\MES\Trident\Void';

    public function testVoidRequest()
    {
        $this->client->setTransactionId('1234567890');
        $this->executeClient();

        $this->assertEquals('V', $this->requestData['transaction_type']);
        $this->assertEquals('1234567890', $this->requestData['transaction_id']);
    }
}
