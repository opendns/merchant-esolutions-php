<?php

abstract class Trident_CardTransactionAbstract Extends TestAbstract
{
    public function testCardTransactionFieldsWithCardNumber()
    {
        $this->client->setAmount(13.37);
        $this->client->setCardExpiration(12, 2017);
        $this->client->setCardNumber('1111 1111 1111 1111');
        $this->client->setClientReferenceNumber('12345');
        $this->client->setCvv2('345');
        $this->client->setInvoiceNumber('5555555');
        $this->client->setStreetAddress('123 Fake Street');
        $this->client->setZipCode('90210');
        $this->executeClient();

        $this->assertEquals('13.37', $this->requestData['transaction_amount']);
        $this->assertEquals('1217', $this->requestData['card_exp_date']);
        $this->assertEquals('1111111111111111', $this->requestData['card_number']);
        $this->assertArrayNotHasKey('card_id', $this->requestData);
        $this->assertEquals('12345', $this->requestData['client_reference_number']);
        $this->assertEquals('345', $this->requestData['cvv2']);
        $this->assertEquals('5555555', $this->requestData['invoice_number']);
        $this->assertEquals('123 Fake Street', $this->requestData['cardholder_street_address']);
        $this->assertEquals('90210', $this->requestData['cardholder_zip']);
    }

    public function testCardTransactionFieldsWithCardId()
    {
        $this->client->setAmount(13.37);
        $this->client->setCardExpiration(12, 2017);
        $this->client->setCardId('abcdefg123456');
        $this->client->setClientReferenceNumber('12345');
        $this->client->setCvv2('345');
        $this->client->setInvoiceNumber('5555555');
        $this->client->setStreetAddress('123 Fake Street');
        $this->client->setZipCode('90210');
        $this->executeClient();

        $this->assertEquals('13.37', $this->requestData['transaction_amount']);
        $this->assertEquals('1217', $this->requestData['card_exp_date']);
        $this->assertEquals('abcdefg123456', $this->requestData['card_id']);
        $this->assertArrayNotHasKey('card_number', $this->requestData);
        $this->assertEquals('12345', $this->requestData['client_reference_number']);
        $this->assertEquals('345', $this->requestData['cvv2']);
        $this->assertEquals('5555555', $this->requestData['invoice_number']);
        $this->assertEquals('123 Fake Street', $this->requestData['cardholder_street_address']);
        $this->assertEquals('90210', $this->requestData['cardholder_zip']);
    }

    public function testSettingCardIdReplacesCardNumber()
    {
        $this->client->setCardNumber('1111 1111 1111 1111');
        $this->client->setCardId('abcdefg123456');
        $this->executeClient();

        $this->assertEquals('abcdefg123456', $this->requestData['card_id']);
        $this->assertArrayNotHasKey('card_number', $this->requestData);
    }

    public function testSettingCardNumberReplacesCardId()
    {
        $this->client->setCardId('abcdefg123456');
        $this->client->setCardNumber('1111 1111 1111 1111');
        $this->executeClient();

        $this->assertEquals('1111111111111111', $this->requestData['card_number']);
        $this->assertArrayNotHasKey('card_id', $this->requestData);
    }

    public function testSetCardExpirationCorrectlyHandlesFourDigitYear()
    {
        $this->client->setCardExpiration(12, 2017);
        $this->executeClient();
        $this->assertEquals('1217', $this->requestData['card_exp_date']);
    }

    public function testSetCardExpirationCorrectlyHandlesTwoDigitYear()
    {
        $this->client->setCardExpiration(12, 17);
        $this->executeClient();
        $this->assertEquals('1217', $this->requestData['card_exp_date']);
    }

    public function testSetCardExpirationCorrectlyHandlesDateTimeInstance()
    {
        $dt = new \DateTime('+2 year', new \DateTimeZone('UTC'));
        $this->client->setCardExpiration($dt);
        $this->executeClient();
        $this->assertEquals($dt->format('md'), $this->requestData['card_exp_date']);
    }

    public function testSetAuthenticationInfo()
    {
        $this->client->setAuthenticationInfo('Gatekeeper', 'Keymaster');
        $this->executeClient();
        $this->assertEquals('Gatekeeper', $this->requestData['profile_id']);
        $this->assertEquals('Keymaster', $this->requestData['profile_key']);
    }

}
