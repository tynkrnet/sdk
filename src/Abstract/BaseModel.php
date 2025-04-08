<?php

namespace Tynkr\Sdk\Abstract;

class BaseModel
{
    public function __construct(private array $data)
    {

    }

    public function get($var)
    {
       if(!isset($this->data[$var])) return null;
       return $this->data[$var];
    }
}