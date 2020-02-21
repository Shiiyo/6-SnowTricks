<?php

namespace App\Tests\Controller\Security;

use App\Tests\Controller\TestGlobalController;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RegistrationControllerTest extends WebTestCase
{
    public function testInscription()
    {
        $test = new TestGlobalController();
        $test->testRenderView('/inscription', 'Inscription');
    }

    public function testModification()
    {
        $client = static::createClient();
        $client->request('GET', '/modification/87');

        $this->assertEquals(302, $client->getResponse()->getStatusCode());
    }
}
