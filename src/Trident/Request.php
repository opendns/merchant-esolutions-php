<?php
namespace OpenDNS\MES\Trident;
use OpenDNS\MES\Request as BaseRequest;

/**
 * Base abstract for Trident API operations
 */
abstract class Request extends BaseRequest
{
    /** @var string The path to an API's endpoints on the server */
    protected $apiBasePath = '/mes-api/tridentApi';

    /** @var string Transaction type to send in the request */
    protected $transactionType;

    public function __construct($environment)
    {
        parent::__construct($environment);
        $this->setField('transaction_type', $this->transactionType);
    }

    /**
     * Sets authentication info for the request
     *
     * This is required before calling execute()
     *
     * @param string $profileId Your MeS Profile ID
     * @param string $profileKey Your MeS Profile Key
     * @return self The current class instance for chaining
     */
    public function setAuthenticationInfo($profileId, $profileKey)
    {
        return $this->setField('profile_id', $profileId)
                    ->setField('profile_key', $profileKey);
    }
}
