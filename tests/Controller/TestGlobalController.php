<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TestGlobalController extends WebTestCase
{
    public function testRenderView($route, $textExpected)
    {
        $client = static::createClient();
        $client->request('GET', $route);
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertSelectorTextContains('h2', $textExpected);

        return $client->getResponse()->getContent();
    }
}
