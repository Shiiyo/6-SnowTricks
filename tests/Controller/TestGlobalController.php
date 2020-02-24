<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TestGlobalController extends WebTestCase
{
    public function testRenderView($route, $code)
    {
        $client = static::createClient();
        $client->request('GET', $route);
        $this->assertEquals($code, $client->getResponse()->getStatusCode());

        return $client->getResponse()->getContent();
    }
}
