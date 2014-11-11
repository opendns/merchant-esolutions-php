<?php

class Reporting_ReportTest Extends TestAbstract
{
    protected $className = 'OpenDNS\MES\Reporting\Report';

    public function testSetAuthenticationInfo()
    {
        $this->client->setAuthenticationInfo('i am user', 'swordfish');
        $this->executeClient();
        $this->assertEquals('i am user', $this->requestData['userId']);
        $this->assertEquals('swordfish', $this->requestData['userPass']);
    }

    public function testSimpleFields()
    {
        $this->client->setReportId(123);
        $this->client->setNodeId(234);
        $this->client->setCustomQueryId(345);
        $this->client->setReportType(1);

        $this->executeClient();

        $this->assertEquals(123, $this->requestData['dsReportId']);
        $this->assertEquals(234, $this->requestData['nodeId']);
        $this->assertEquals(345, $this->requestData['queryId']);
        $this->assertEquals(1, $this->requestData['reportType']);
    }

    public function testBooleanFieldsWithTrueHaveStringyBooleans()
    {
        $this->client->setIncludeTridentTransactionId(true);
        $this->client->setIncludePurchaseId(true);
        $this->executeClient();
        $this->assertSame('true', $this->requestData['includeTridentTranId']);
        $this->assertSame('true', $this->requestData['includePurchaseId']);
    }

    public function testBooleanFieldsWithFalseHaveStringyBooleans()
    {
        $this->client->setIncludeTridentTransactionId(false);
        $this->client->setIncludePurchaseId(false);
        $this->executeClient();
        $this->assertSame('false', $this->requestData['includeTridentTranId']);
        $this->assertSame('false', $this->requestData['includePurchaseId']);
    }

    public function testDateFieldsSetAllExpectedFields()
    {
        $startDate = new \DateTime('2015-01-23', new \DateTimeZone('UTC'));

        $endDate = clone $startDate;
        $endDate->modify('+1 month');

        $this->client->setBeginDate($startDate);
        $this->client->setEndDate($endDate);

        $this->executeClient();

        $this->assertEquals($startDate->format('m') - 1, $this->requestData['beginDate.month']);
        $this->assertEquals($startDate->format('d'), $this->requestData['beginDate.day']);
        $this->assertEquals($startDate->format('Y'), $this->requestData['beginDate.year']);
        $this->assertEquals($startDate->format('m/d/Y'), $this->requestData['reportDateBegin']);

        $this->assertEquals($endDate->format('m') - 1, $this->requestData['endDate.month']);
        $this->assertEquals($endDate->format('d'), $this->requestData['endDate.day']);
        $this->assertEquals($endDate->format('Y'), $this->requestData['endDate.year']);
        $this->assertEquals($endDate->format('m/d/Y'), $this->requestData['reportDateEnd']);
    }

}
