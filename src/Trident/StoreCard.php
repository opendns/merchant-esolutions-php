<?php
namespace OpenDNS\MES\Trident;

/**
 * Store a card for later use.
 *
 * Will return a card_id you can use in subsequent transactions.
 */
class StoreCard extends CardTransaction
{
    /** @var string Transaction type to send in the request */
    protected $transactionType = 'T';
}
