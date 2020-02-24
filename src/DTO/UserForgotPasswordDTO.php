<?php

namespace App\DTO;

class UserForgotPasswordDTO
{
    public $username;

    /**
     * UserForgotPasswordDTO constructor.
     *
     * @param $username
     */
    public function __construct($username)
    {
        $this->username = $username;
    }
}
