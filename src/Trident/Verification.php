<?php
namespace OpenDNS\MES\Trident;

/**
 * Verify a card without actually reserving any funds
 */
class Verification extends CardTransaction
{
    /** @var string Transaction type to send in the request */
    protected $transactionType = 'A';
}
