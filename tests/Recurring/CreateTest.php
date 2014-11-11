<?php

class Recurring_CreateTest extends Recurring_DetailRequestAbstract
{
    protected $className = 'OpenDNS\MES\Recurring\Create';

    public function testCreateRequest()
    {
        $this->client->setRecurFrequency('MONTHLY');
        $this->executeClient();
        $this->assertEquals('MONTHLY', $this->requestData['recur_frequency']);
    }
}
