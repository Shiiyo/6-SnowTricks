<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TrickControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $test = new TestGlobalController();
        $content = $test->testRenderView('/trick/40', 'Commentaires');
        $this->assertContains('pariatur harum', $content);
    }
}
