<?php
namespace OpenDNS\MES\Recurring;

/**
 * Abstract with setters for recurring billing profiles
 */
abstract class RecurringDetailRequest extends Request
{

    /**
     * Sets Amount to charge each billing cycle
     *
     * @param int $recurringAmount
     *
     * @return self The current class instance for chaining
     */
    public function setRecurringAmount($recurringAmount)
    {
        return $this->setField('recur_amount', $recurringAmount);
    }

    /**
     * Sets starting date of the recurring payments
     * @param DateTime $startDate
     *
     * @return self The current class instance for chaining
     */
    public function setRecurringStartDate(\DateTime $startDate)
    {
        return $this->setField('recur_start_date', $startDate->format('m/d/y'));
    }

    /**
     * Sets number of payments to process over the lifespan of the profile, or 0 for infinite
     *
     * @param int $payments
     *
     * @return self The current class instance for chaining
     */
    public function setNumberofPayments($payments)
    {
        return $this->setField('recur_num_pmt', $payments);
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
        return $this->removeField('card_id')
                    ->setField('card_number', $cardNumber);
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
    public function setCardExpiration($month, $year)
    {
        $month = str_pad($month, 2, '0', STR_PAD_LEFT);

        $year = substr(str_pad($year, 2, '0', STR_PAD_LEFT), -2);

        return $this->setField('card_exp_date', $month . $year);
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
     * @param int $zipCode
     * @return self The current class instance for chaining
     */
    public function setZipCode($zipCode)
    {
        return $this->setField('cardholder_zip', $zipCode);
    }

    /**
     * Sets the amount of tax to charge on the transaction
     *
     * @param int $taxAmount
     * @return self The current class instance for chaining
     */
    public function setTaxAmount($taxAmount)
    {
        return $this->setField('tax_amount', $taxAmount);
    }

}
