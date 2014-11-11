<?php
namespace OpenDNS\MES\Trident;

/**
 * Void a previous preauthorization transaction.
 *
 * If you want to void a Sale or Capture, use Refund instead.
 */
class Void extends Request
{
    /** @var string Transaction type to send in the request */
    protected $transactionType = 'V';

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
