<?php

class Trident_VerificationTest extends Trident_CardTransactionAbstract
{
    protected $className = 'OpenDNS\MES\Trident\Verification';

    public function testVerificationTransactionType()
    {
        $this->executeClient();
        $this->assertEquals('A', $this->requestData['transaction_type']);
    }
}
