<?php

class Recurring_UpdateTest extends Recurring_DetailRequestAbstract
{
    protected $className = 'OpenDNS\MES\Recurring\Update';

    public function testUpdateRequest()
    {
        $date = new DateTime('now');
        $this->client->setNextDate($date);
        $this->executeClient();
        $this->assertEquals($date->format('m/d/y'), $this->requestData['nextDate']);
    }
}
