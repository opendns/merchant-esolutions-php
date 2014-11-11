<?php

class Trident_SaleTest Extends Trident_CardTransactionAbstract
{
    protected $className = 'OpenDNS\MES\Trident\Sale';

    public function testStoreCardTransactionType()
    {
        $this->executeClient();
        $this->assertEquals('D', $this->requestData['transaction_type']);
    }
}
