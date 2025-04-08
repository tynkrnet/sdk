<?php

namespace Tynkr\Sdk\API;

use Tynkr\Sdk\Internal\Request;
use Tynkr\Sdk\Models\User;

class Authorization
{

    public function __construct(private string $baseUri, private string $secretKey)
    {
    }

    /**
     * @throws \Exception
     */
    public function authorize($token)
    {
        $request = new Request();
        return new User($request->get($this->baseUri."/approve?access_token=".$token."&client_secret=".$this->secretKey));
    }
}