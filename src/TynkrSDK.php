<?php

namespace Tynkr\Sdk;

use Tynkr\Sdk\API\Authorization;
define('TYNKER_API_URL', 'https://services.tynkr.net/api/');
class TynkrSDK
{
    public function __construct(private string $secret)
    {
    }

    public function getAuthorizationService()
    {
        return new Authorization(TYNKER_API_URL."/oauth", $this->secret);
    }
}