<?php

namespace App\DTO;

use Symfony\Component\Validator\Constraints as Assert;

class AccountDTO
{
    /**
     * @Assert\Length(
     *     min = 3,
     *     minMessage="Votre pseudo est trop court ( {{ limit }} caractères mini).",
     *     max= 30,
     *     maxMessage="Votre pseudo est trop long ( {{ limit }} caractères maxi)."
     * )
     */
    public $username;
    /**
     * @Assert\Email
     */
    public $email;
    /**
     * @Assert\Valid
     */
    public $picture;

    /**
     * AccountDTO constructor.
     *
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
