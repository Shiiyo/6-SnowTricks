<?php

namespace App\Tests\Controller\Security;

use App\Tests\Controller\TestGlobalController;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DeleteUserControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $test = new TestGlobalController();
        $test->testRenderView('/delete/87', 302);
    }
}
