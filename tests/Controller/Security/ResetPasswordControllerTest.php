<?php

namespace App\Tests\Controller\Security;

use App\Tests\Controller\TestGlobalController;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ResetPasswordControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $test = new TestGlobalController();
        $test->testRenderView('/reset-password/42', 302);
    }
}
