<?php

class Trident_PreAuthorizationTest Extends Trident_CardTransactionAbstract
{
    protected $className = 'OpenDNS\MES\Trident\PreAuthorization';

    public function testStoreCardTransactionType()
    {
        $this->executeClient();
        $this->assertEquals('P', $this->requestData['transaction_type']);
    }

    public function testSetStoreCardAsTrueDoesProperBooleanType()
    {
        $this->client->setStoreCard(true);
        $this->executeClient();
        $this->assertEquals('y', $this->requestData['store_card']);

    }

    public function testSetStoreCardAsFalseDoesProperBooleanType()
    {
        $this->client->setStoreCard(false);
        $this->executeClient();
        $this->assertEquals('n', $this->requestData['store_card']);
    }
}
