<?php

namespace App\DTO;

class AccountDTO
{
    public $username;
    public $email;
    public $picture;

    /**
     * AccountDTO constructor.
     * @param $username
     * @param $email
     * @param $picture
     */
    public function __construct($username, $email, $picture)
    {
        $this->username = $username;
        $this->email = $email;
        $this->picture = $picture;
    }
}