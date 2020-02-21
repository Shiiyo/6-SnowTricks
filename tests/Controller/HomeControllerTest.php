<?php

namespace App\Tests\Controller;

use App\Controller\HomeController;
use App\Repository\TrickRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class HomeControllerTest extends WebTestCase
{
    public function testIndex()
    {
        static::bootKernel();

        $repo = $this->createMock(TrickRepository::class);
        $homepage = new HomeController();

        $homepage->setContainer(static::$container);

        $returnTest = $homepage->index($repo);
        $this->assertInstanceOf(Response::class, $returnTest);
    }
}
