<?php
namespace OpenDNS\MES\Trident;

/**
 * Delete a stored credit card
 *
 * If you want to refund an already-processed transaction, use Refund instead.
 */
class DeleteStoredCard extends Request
{
    /** @var string Transaction type to send in the request */
    protected $transactionType = 'X';

    /**
     * Set the card ID to delete
     *
     * This is a 32-character alphanumeric ID returned from a previous 'Store Card'
     * call.
     *
     * @param int|string $cardId
     * @return self The current class instance for chaining
     */
    public function setCardId($cardId)
    {
        return $this->setField('card_id', $cardId);
    }
}
