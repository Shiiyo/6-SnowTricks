<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class HomeControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $test = new TestGlobalController();
        $test->testRenderView('/', 'Tremplin aux acrobates');
    }
}
