<?php
namespace OpenDNS\MES\Trident;

/**
 * Execute a preauthorization and capture in one operation.
 */
class Sale extends CardTransaction
{
    /** @var string Transaction type to send in the request */
    protected $transactionType = 'D';
}
