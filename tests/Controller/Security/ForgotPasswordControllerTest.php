<?php

namespace App\Tests\Controller\Security;


use App\Tests\Controller\TestGlobalController;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ForgotPasswordControllerTest extends WebTestCase
{
    public function testInscription()
    {
        $test = new TestGlobalController();
        $test->testRenderView('/forgot-password', 'Mot de passe oublié');
    }
}