<?php
namespace OpenDNS\MES\Trident;

/**
 * Issue a credit.
 *
 * If you want to refund an already-processed transaction, use Refund instead.
 */
class Credit extends CardTransaction
{
    protected $transactionType = 'C';
}
