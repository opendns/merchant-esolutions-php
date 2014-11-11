<?php
namespace OpenDNS\MES\Trident;

/**
 *  Abstract for endpoints that accept a credit card and all its details
 */
abstract class CardTransaction extends Request
{
    /**
     * Sets the amount of the transaction
     *
     * @param float|string $amount
     * @return self The current class instance for chaining
     */
    public function setAmount($amount)
    {
        return $this->setField('transaction_amount', $amount);
    }

    /**
     * Sets the credit card expiration date.
     *
     * Accepts strings because that's most commonly how they're
     * implemented in web forms. You can also pass a \DateTime instance as a single argument
     *
     * @param int|string|\DateTime $month Either the expiration month or a datetime representing the whole expiration date
     * @param int|string|null $year Expiration year (2 or 4 digits) or omit if using a \DateTime
     * @return self The current class instance for chaining
     */
    public function setCardExpiration($month, $year = null)
    {
        $expDate = null;

        if ($month instanceof \DateTime) {
            $expDate = $month->format('md');
        } else if ($month && $year) {
            $expDate = str_pad($month, 2, '0', STR_PAD_LEFT)
                . substr(str_pad($year, 2, '0', STR_PAD_LEFT), -2);
        }

        return $this->setField('card_exp_date', $expDate);
    }

    /**
     * Sets a card ID from a previous 'Store Card' operation to charge.
     *
     * This is mutually exclusive of setting the card number. Setting a Card ID
     * will unset any previously set card number.
     *
     * @param string $cardId 32-character card ID
     * @return self The current class instance for chaining
     */
    public function setCardId($cardId)
    {
        return $this->removeField('card_number')
                    ->setField('card_id', $cardId);
    }

    /**
     * Sets the credit card number to charge.
     *
     * This is mutually exclusive of setting the card id. Setting a card number
     * will unset any previously set card id.
     *
     * @param string $cardNumber 15 or 16 digit credit card number
     * @return self The current class instance for chaining
     */
    public function setCardNumber($cardNumber)
    {
        $cardNumber = preg_replace('/[^0-9]/', '', $cardNumber);

        return $this->removeField('card_id')
                    ->setField('card_number', $cardNumber);
    }

    /**
     * Sets a reference number that's of significance to the client.
     *
     * This might be an order number or some other value that you the
     * merchant would like to be able to refer to. It can't contain '&' or '='
     * for some reason
     *
     * @param int|string $referenceNumber A number of some interest to you.
     * @return self The current class instance for chaining
     */
    public function setClientReferenceNumber($referenceNumber)
    {
        return $this->setField('client_reference_number', $referenceNumber);
    }

    /**
     * Sets the card's CVV2 value for extra verification.
     *
     * Requires that CVV2 support be enabled on your account by MeS.
     *
     * @param int|string $cvv2 A 3 or 4 digit card verification number
     * @return self The current class instance for chaining
     */
    public function setCvv2($cvv2)
    {
        return $this->setField('cvv2', $cvv2);
    }

    /**
     * Sets the invoice number for the transaction.
     *
     * Limited to 0-9, a-z, A-Z, and spaces.
     *
     * @param int|string $invoiceNumber
     * @return self The current class instance for chaining
     */
    public function setInvoiceNumber($invoiceNumber)
    {
        return $this->setField('invoice_number', $invoiceNumber);
    }

    /**
     * Sets the cardholder's street address for verification
     *
     * Just the first line ('123 Fake Street', for example)
     *
     * @param string $streetAddress
     * @return self The current class instance for chaining
     */
    public function setStreetAddress($streetAddress)
    {
        return $this->setField('cardholder_street_address', $streetAddress);
    }

    /**
     * Sets the cardholder's ZIP code (or postal code) for verification
     *
     * Can be either 5 or 9 digits long.
     *
     * @param int $streetAddress
     * @return self The current class instance for chaining
     */
    public function setZipCode($zipCode)
    {
        return $this->setField('cardholder_zip', $zipCode);
    }

}
