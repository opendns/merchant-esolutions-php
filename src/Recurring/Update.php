<?php
namespace OpenDNS\MES\Recurring;

/**
 * Updates a recurring billing profile.
 */
class Update extends RecurringDetailRequest
{
    /** @var string endpoint path for updating recurring billing */
    protected $apiEndpointPath = 'rbsUpdate';

    /**
     * Sets Next Date for recurring billing.
     *
     * @param DateTime object representing the next payment date
     *
     * @return self
     */
    public function setNextDate(\DateTime $nextDate)
    {
        return $this->setField('nextDate', $nextDate->format('m/d/y'));
    }

}
