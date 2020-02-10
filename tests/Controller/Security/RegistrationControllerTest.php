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
        $test = new TestGlobalController();
        $content = $test->testRenderView('/modification/87', 'Modification du compte');
        $this->assertContains('Shiyo', $content);
    }
}
