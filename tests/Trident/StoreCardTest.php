<?php

class Trident_StoreCardTest Extends Trident_CardTransactionAbstract
{
    protected $className = 'OpenDNS\MES\Trident\StoreCard';

    public function testStoreCardTransactionType()
    {
        $this->executeClient();
        $this->assertEquals('T', $this->requestData['transaction_type']);
    }
}
