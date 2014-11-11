<?php
namespace OpenDNS\MES\Recurring;
use OpenDNS\MES\Request as BaseRequest;

/**
 * Abstract for CUD operations on Recurring billing Profiles.
 */
abstract class Request extends BaseRequest
{
    const FREQUENCY_MONTHLY = 'MONTHLY';
    const FREQUENCY_QUARTERLY = 'QUARTERLY';
    const FREQUENCY_ANNUALLY = 'ANNUALLY';

    /**
     * @var string $apiBasePath
     */
    protected $apiBasePath = '/srv/api';

    protected $httpMethod = 'GET';

    /**
     * Sets authentication info.
     *
     * @param int $profileId
     * @param int|string $userId
     * @param int|string $password
     *
     * @return self
     */
    public function setAuthenticationInfo($profileId, $userId, $password)
    {
        return $this->setField('profileId', $profileId)
                    ->setField('userId', $userId)
                    ->setField('userPass', $password);
    }

    /**
     * Sets a Unique ID for the customer.
     *
     * @param int|string $customerId
     *
     * @return self
     */
    public function setCustomerId($customerId)
    {
        return $this->setField('customer_id', $customerId);
    }

}
