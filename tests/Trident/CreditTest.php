<?php

class Trident_CreditTest Extends Trident_CardTransactionAbstract
{
    protected $className = 'OpenDNS\MES\Trident\Credit';

    public function testStoreCardTransactionType()
    {
        $this->executeClient();
        $this->assertEquals('C', $this->requestData['transaction_type']);
    }
}
