<?php
namespace OpenDNS\MES\Reporting;
use OpenDNS\MES\Request;

class Report extends Request
{
    const REPORT_ACHP_RETURN_SUMMARY = 18;
    const REPORT_ACHP_SETTLEMENT_SUMMARY = 17;
    const REPORT_AUTHORIZATION_LOG = 15;
    const REPORT_BATCH_SUMMARY = 1;
    const REPORT_CHARGEBACK_ADJUSTMENTS = 5;
    const REPORT_CUSTOM = 9;
    const REPORT_DAILY_INTERCHANGE_SUMMARY = 8;
    const REPORT_DEPOSIT_SUMMARY = 3;
    const REPORT_FX_BATCH_SUMMARY = 10;
    const REPORT_FX_INTERCHANGE_SUMMARY = 13;
    const REPORT_INTERNATIONAL_CHARGEBACKS = 11;
    const REPORT_INTERNATIONAL_RETRIEVAL_REQUESTS = 12;
    const REPORT_INTERNATIONAL_SETTLEMENT_SUMMARY = 14;
    const REPORT_PAYMENT_GATEWAY_REJECTED_TRANSACTIONS = 23;
    const REPORT_PAYMENT_GATEWAY_SETTLED_TRANSACTIONS = 22;
    const REPORT_PAYMENT_GATEWAY_UNSETTLED_TRANSACTIONS = 21;
    const REPORT_RETRIEVAL_REQUESTS = 7;
    const REPORT_SETTLEMENT_SUMMARY = 2;

    const TYPE_SUMMARY = 0;
    const TYPE_DETAIL = 1;

    const QUERY_VISA_ARDEF_TABLES = 283;
    const QUERY_MC_ARDEF_TABLES = 284;

    protected $httpMethod = 'GET';

    protected $defaultFieldValues = array(
        'reportType' => 0,
        'encoding' => 'csv',
        'includeTridentTranId' => 'true',
    );

    protected $apiBasePath = '/jsp/reports/report_api.jsp';

    /**
     * Sets authentication info for the request
     *
     * This is required before calling execute()
     *
     * @param string $profileId Your MeS User ID
     * @param string $profileKey Your MeS Password
     * @return self The current class instance for chaining
     */
    public function setAuthenticationInfo($userId, $password)
    {
        return $this->setField('userId', $userId)
                    ->setField('userPass', $password);
    }

    /**
     * Sets the report ID you'd like returned
     *
     * Expected values are the REPORT_ consts from this class
     *
     * @param int $reportId A report id
     * @return self The current class instance for chaining
     */
    public function setReportId($reportId)
    {
        return $this->setField('dsReportId', $reportId);
    }

    /**
     * Sets the start date of the report
     *
     * @param \DateTime $reportId A datetime instance representing the start date of the report
     * @return self The current class instance for chaining
     */
    public function setBeginDate(\DateTime $startDate)
    {
        // Note: The api expects months to be 0-indexed
        return $this->setField('beginDate.month', $startDate->format('m') - 1)
                    ->setField('beginDate.day', $startDate->format('d'))
                    ->setField('beginDate.year', $startDate->format('Y'))
                    ->setField('reportDateBegin', $startDate->format('m/d/Y'));
    }

    /**
     * Sets the end date of the report
     *
     * @param \DateTime $reportId A datetime instance representing the end date of the report
     * @return self The current class instance for chaining
     */
    public function setEndDate(\DateTime $endDate)
    {
        // Note: The api expects months to be 0-indexed
        return $this->setField('endDate.month', $endDate->format('m') - 1)
                    ->setField('endDate.day', $endDate->format('d'))
                    ->setField('endDate.year', $endDate->format('Y'))
                    ->setField('reportDateEnd', $endDate->format('m/d/Y'));
    }

    /**
     * Sets the node ID (AKA merchant account number)
     *
     * @param string $nodeId
     * @return self The current class instance for chaining
     */
    public function setNodeId($nodeId)
    {
        return $this->setField('nodeId', $nodeId);
    }

    /**
     * Sets the report type to return.
     *
     * Valid values are the TYPE_ constants from this class
     *
     * @param int $reportType
     * @return self The current class instance for chaining
     */
    public function setReportType($reportType)
    {
        return $this->setField('reportType', $reportType);
    }

    /**
     * Sets whether the report should include the trident transaction ID or not
     *
     * @param bool $includeId
     * @return self The current class instance for chaining
     */
    public function setIncludeTridentTransactionId($includeId)
    {
        return $this->setField('includeTridentTranId', $includeId ? 'true' : 'false');
    }

    /**
     * Sets whether the report should include the purchase ID or not
     *
     * @param bool $includeId
     * @return self The current class instance for chaining
     */
    public function setIncludePurchaseId($includeId)
    {
        return $this->setField('includePurchaseId', $includeId ? 'true' : 'false');
    }

    /**
     * Sets a customer query ID to be run.
     *
     * This is only for use when fetching reports of type REPORT_CUSTOM. Some
     * defaults are specified in the QUERY_ constants above.
     *
     * @param int $queryId
     * @return self The current class instance for chaining
     */
    public function setCustomQueryId($queryId)
    {
        return $this->setField('queryId', $queryId);
    }

}
