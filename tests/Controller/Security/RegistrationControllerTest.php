<?php

namespace App\Tests\Controller\Security;

use App\Tests\Controller\TestGlobalController;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RegistrationControllerTest extends WebTestCase
{
    public function testInscription()
    {
        $test = new TestGlobalController();
        $test->testRenderView('/inscription', 200);
    }

    public function testModification()
    {
        $test = new TestGlobalController();
        $test->testRenderView('/admin/modification-compte/87', 302);
    }
}
