<?php

class Trident_DeleteStoredCardTest Extends TestAbstract
{
    protected $className = 'OpenDNS\MES\Trident\DeleteStoredCard';

    public function testsetCardId()
    {
        $this->client->setCardId('1234avxx34040302dsflsa39AA');
        $this->executeClient();

        $this->assertEquals('1234avxx34040302dsflsa39AA', $this->requestData['card_id']);
        $this->assertEquals('X', $this->requestData['transaction_type']);
    }
}
