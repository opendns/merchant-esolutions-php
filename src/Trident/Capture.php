<?php
namespace OpenDNS\MES\Trident;

/**
 *  Capture a previously authorized transaction
 */
class Capture extends Request
{
    /** @var string Transaction type to send in the request */
    protected $transactionType = 'S';

    /**
     * Sets the amount to settle.
     *
     * The settle amount can be different than the preauthorized amount.
     *
     * @param float|string $amount
     * @return self The current class instance for chaining
     */
    public function setAmount($amount)
    {
        return $this->setField('transaction_amount', $amount);
    }

    /**
     * Set the invoice number for the transaction.
     *
     * It's only required if it wasn't submitted with the preauthorization
     * that's being captured. Limited to a-z, A-Z, 0-9, and spaces.
     *
     * @param int|string $invoiceNumber
     * @return self The current class instance for chaining
     */
    public function setInvoiceNumber($invoiceNumber)
    {
        return $this->setField('invoice_number', $invoiceNumber);
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
