<?php

namespace App\Tests\Controller\Security;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DeleteUserControllerTest extends WebTestCase
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $entityManager;

    protected function setUp(): void
    {
        $kernel = self::createKernel();
        $kernel->boot();

        $this->entityManager = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();
    }

    public function testIndex()
    {
        //Create a fake User to delete
        $user = new User();
        $user->setPassword('toto')
            ->setEmail('toto')
            ->setUsername('toto')
            ->setIsActive(0);
        $this->entityManager->persist($user);
        $this->entityManager->flush();

        $user_id = $user->getId();

        //Delete it
        $client = static::createClient();
        $client->request('GET', '/delete/'.$user_id);
        $userInRepo = $this->entityManager->getRepository(User::class)->findOneBy(['id' => $user_id]);

        //Test is correctly delete
        $this->assertNull($userInRepo);
        $this->assertEquals(302, $client->getResponse()->getStatusCode());
    }
}
