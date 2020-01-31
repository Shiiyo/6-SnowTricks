<?php

namespace App\Tests;

use App\Entity\Picture;
use App\Entity\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    private $user;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->user = new User();
    }

    public function testEmail()
    {
        $this->user->setEmail('test@test.fr');
        $this->assertEquals('test@test.fr', $this->user->getEmail());
    }

    public function testName()
    {
        $this->user->setName('Test');
        $this->assertEquals('Test', $this->user->getName());
    }

    public function testFirstName()
    {
        $this->user->setFirstName('Test');
        $this->assertEquals('Test', $this->user->getFirstName());
    }

    public function testPassword()
    {
        $this->user->setPassword('Test');
        $this->assertEquals('Test', $this->user->getPassword());
    }

    public function testPicture()
    {
        $picture = new Picture();
        $this->user->setPicture($picture);
        $this->assertEquals($picture, $this->user->getPicture());
    }
}
