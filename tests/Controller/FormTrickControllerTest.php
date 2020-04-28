<?php

namespace Controller;

use App\Tests\Controller\TestGlobalController;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class FormTrickControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient([], [
            'PHP_AUTH_USER' => 'Test',
            'PHP_AUTH_PW'   => 'Pa$$word1',
        ]);

        $client->request('GET', '/admin/nouveau-trick');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        return $client->getResponse()->getContent();
    }
}