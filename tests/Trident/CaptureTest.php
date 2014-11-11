<?php

class Trident_CaptureTest Extends TestAbstract
{
    protected $className = 'OpenDNS\MES\Trident\Capture';

    public function testCaptureRequest()
    {
        $this->client->setAmount('100');
        $this->client->setTransactionId('1234567');
        $this->client->setInvoiceNumber('AbC2394C');
        $this->executeClient();

        $this->assertEquals('S', $this->requestData['transaction_type']);
        $this->assertEquals('1234567', $this->requestData['transaction_id']);
        $this->assertEquals('AbC2394C', $this->requestData['invoice_number']);
    }
}
