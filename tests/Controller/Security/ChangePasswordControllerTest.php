<?php

namespace Controller\Security;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ChangePasswordControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient([], [
            'PHP_AUTH_USER' => 'Test',
            'PHP_AUTH_PW'   => 'Pa$$word1',
        ]);

        $client->request('GET', '/admin/mot-de-passe/1');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        return $client->getResponse()->getContent();
    }
}