<?php
namespace OpenDNS\MES\Trident;

/**
 * Pre-Authorize a transaction.
 *
 * Confirms that funds are available and reserves them for a short time. Must
 * be captured if you want to keep the money.
 */
class PreAuthorization extends CardTransaction
{
    /** @var string Transaction type to send in the request */
    protected $transactionType = 'P';

    /**
     * Sets the flag to store this card number for future use.
     *
     * If true, the card will be stored and a card_id will be returned. If false,
     * it won't.
     *
     * @param bool $enable
     * @return self The current class instance for chaining
     */
    public function setStoreCard($enable)
    {
        $this->setField('store_card', $enable ? 'y' : 'n');
    }
}
