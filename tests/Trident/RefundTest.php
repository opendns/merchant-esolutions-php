<?php

class Trident_RefundTest Extends TestAbstract
{
    protected $className = 'OpenDNS\MES\Trident\Refund';

    public function testRefundRequest()
    {
        $this->client->setAmount('100');
        $this->client->setTransactionId('1234567');
        $this->executeClient();

        $this->assertEquals('U', $this->requestData['transaction_type']);
        $this->assertEquals('100', $this->requestData['transaction_amount']);
        $this->assertEquals('1234567', $this->requestData['transaction_id']);
    }
}
