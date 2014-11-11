<?php
namespace OpenDNS\MES\Trident;

/**
 * Reauthorize a previous authorization.
 *
 * Allows you to change the amount of the authorization or to refresh an
 * existing one to prevent it from expiring.
 */
class ReAuthorization extends Request
{
    /** @var string Transaction type to send in the request */
    protected $transactionType = 'J';

    /**
     * Sets a new amount to authorize
     *
     * @param float|string $amount
     * @return self The current class instance for chaining
     */
    public function setAmount($amount)
    {
        return $this->setField('transaction_amount', $amount);
    }

    /**
     * Set the transaction ID of a previous preauthorization transaction.
     *
     * @param string $transactionID
     * @return self The current class instance for chaining
     */
    public function setTransactionId($transactionId)
    {
        return $this->setField('transaction_id', $transactionId);
    }
}
