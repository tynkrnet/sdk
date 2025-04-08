<?php

namespace Tynkr\Sdk\Models;

use Tynkr\Sdk\Abstract\BaseModel;

class User extends BaseModel
{

    public string|int $id;
    public string|null $firstname;
    public string|null $lastname;
    public string|null $email;

    public function __construct(array $data)
    {
        parent::__construct($data);
        $this->id = $this->get('id');
        $this->firstname = $this->get('firstname');
        $this->lastname = $this->get('lastname');
        $this->email = $this->get('email');
    }

}