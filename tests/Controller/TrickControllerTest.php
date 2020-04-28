<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TrickControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $test = new TestGlobalController();
        $test->testRenderView('/trick/1620', 200);
    }
}
