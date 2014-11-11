<?php

class Recurring_DeleteTest extends TestAbstract
{
    protected $className = 'OpenDNS\MES\Recurring\Delete';

    public function testDeleteRequest()
    {
        $this->client->setAuthenticationInfo('i am profile', 'i am user', 'swordfish');
        $this->client->setCustomerId('abc123');
        $this->executeClient();
        $this->assertEquals('i am profile', $this->requestData['profileId']);
        $this->assertEquals('i am user', $this->requestData['userId']);
        $this->assertEquals('swordfish', $this->requestData['userPass']);
        $this->assertEquals('abc123', $this->requestData['customer_id']);
    }

}
