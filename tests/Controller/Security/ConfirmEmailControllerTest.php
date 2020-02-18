<?php

namespace App\Tests\Controller\Security;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ConfirmEmailControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();
        $client->request('GET', '/registration/xxxxxxxxxxxx');
        $this->assertEquals(302, $client->getResponse()->getStatusCode());
    }
}
