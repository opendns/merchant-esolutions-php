<?php
namespace OpenDNS\MES\Trident;

/**
 * Refund a previously captured transaction.
 */
class Refund extends Request
{
    /** @var string Transaction type to send in the request */
    protected $transactionType = 'U';

    /**
     * Sets the amount to refund.
     *
     * This is only required if you want to refund less than the full amount. If
     * omitted, the whole transaction amount will be refunded.
     *
     * @param float|string $amount
     * @return self The current class instance for chaining
     */
    public function setAmount($amount)
    {
        return $this->setField('transaction_amount', $amount);
    }

    /**
     * Set the transaction ID of a previous capture or sale transaction.
     *
     * @param string $transactionID
     * @return self The current class instance for chaining
     */
    public function setTransactionId($transactionId)
    {
        return $this->setField('transaction_id', $transactionId);
    }
}
