<?php

namespace App\Tests\Repository;

use App\Entity\User;
use App\Tests\AbstractRepositoryTest;
use App\Utils\Paginator;
use Doctrine\Common\DataFixtures\Executor\ORMExecutor;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserRepositoryTest extends AbstractRepositoryTest
{
    private EntityRepository $userRepository;

    public function testGetPage()
    {
        for ($i = 0; $i < 26; ++$i) {
            $user = $this->getEntity()->setEmail($i . '_demo@demo.com');

            $this->em->persist($user);
        }

        $this->em->flush();

        $repository = $this->userRepository->getPage();
        $this->assertInstanceOf(Paginator::class, $repository);
        $this->assertEquals(26, $repository->getResultCount());
        $this->assertEquals(2, $repository->getTotalPages());
        $this->assertCount(25, $repository->getData());

        $repository = $this->userRepository->getPage(2);

        $this->assertInstanceOf(Paginator::class, $repository);
        $this->assertEquals(26, $repository->getResultCount());
        $this->assertEquals(2, $repository->getTotalPages());
        $this->assertCount(1, $repository->getData());
    }

    private function getEntity(): User
    {
        $user = new User();
        $user->setFirstName('Firstname');
        $user->setLastName('Lastname');
        $user->setEmail('demo@demo.com');
        $user->setPassword('demo1234');
        $user->setRoles(['ROLE_USER']);

        return $user;
    }

    /**
     * @throws \Exception
     */
    protected function setUp(): void
    {
        parent::setUp();

        $purger = new ORMPurger($this->em);
        $executor = new ORMExecutor($this->em, $purger);
        $executor->purge();

        $this->userRepository = $this->em->getRepository(User::class);
    }
}
