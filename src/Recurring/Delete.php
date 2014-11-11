<?php
namespace OpenDNS\MES\Recurring;

/**
 * Deletes a recurring billing profile.
 */
class Delete extends Request
{
    /** @var string $apiEndpointPath */
    protected $apiEndpointPath = 'rbsDelete';
}
