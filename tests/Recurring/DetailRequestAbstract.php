<?php

abstract class Recurring_DetailRequestAbstract extends TestAbstract
{

    public function testRecurringDetailRequestAbstractFields()
    {
        $date = new DateTime('now');

        $this->client->setRecurringAmount(13.37);
        $this->client->setRecurringStartDate($date);
        $this->client->setNumberofPayments(16);
        $this->client->setClientReferenceNumber('Abc38829sd');
        $this->client->setCardId('1237djxlsdk23AD');
        $this->client->setCardNumber('55557777117715');
        $this->client->setCardExpiration('10', '22');
        $this->client->setStreetAddress('1600 Pennsylvania Ave');
        $this->client->setZipCode(94107);
        $this->client->setTaxAmount(17);
        $this->executeClient();

        $this->assertEquals('13.37', $this->requestData['recur_amount']);
        $this->assertEquals('16', $this->requestData['recur_num_pmt']);
        $this->assertEquals('13.37', $this->requestData['recur_amount']);
        $this->assertEquals($date->format('m/d/y'), $this->requestData['recur_start_date']); 
        $this->assertEquals('Abc38829sd', $this->requestData['client_reference_number']); 
        $this->assertEquals('55557777117715', $this->requestData['card_number']);
        $this->assertEquals('1022', $this->requestData['card_exp_date']);
        $this->assertEquals('1600 Pennsylvania Ave', $this->requestData['cardholder_street_address']);
        $this->assertEquals('94107', $this->requestData['cardholder_zip']);
        $this->assertEquals('17', $this->requestData['tax_amount']);
    }

}
