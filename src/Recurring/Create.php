<?php
namespace OpenDNS\MES\Recurring;

/**
 * Creates a recurring billing profile.
 */
class Create extends RecurringDetailRequest
{
    const FREQUENCY_MONTHLY = 'MONTHLY';
    const FREQUENCY_QUARTERLY = 'QUARTERLY';
    const FREQUENCY_ANNUALLY = 'ANNUALLY';

    /** @var string $apiEndpointPath */
    protected $apiEndpointPath = 'rbsCreate';

    /** @var array default payment field values */
    protected $defaultFieldValues = array(
        'recur_num_pmt' => 0,
        'payment_type' => 'CC',
    );

    /**
     *  Sets how often to bill the customer's card.
     *
     *  @param string One of the FREQUENCY constants from this class
     *
     *  @return self
     */
    public function setRecurFrequency($frequency)
    {
        return $this->setField('recur_frequency', $frequency);
    }

}
