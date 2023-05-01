<?php

namespace App\Tests\Services;

use App\Entity\User;
use App\Model\Request\SignUpRequest;
use App\Repository\UserRepository;
use App\Services\SignUpService;
use Lexik\Bundle\JWTAuthenticationBundle\Security\Http\Authentication\AuthenticationSuccessHandler;
use PHPUnit\Framework\TestCase;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class SignUpServiceTest extends TestCase
{
    private UserPasswordHasherInterface $hasher;
    private UserRepository $userRepository;
    private AuthenticationSuccessHandler $successHandler;

    /**
     * @throws \Exception
     */
    public function testSignUp()
    {
        $this->userRepository->expects($this->once())
            ->method('saveAndCommit')
            ->with($this->getEntity());

        (new SignUpService($this->hasher, $this->userRepository, $this->successHandler))
            ->signUp($this->getRequest());
    }

    private function getEntity($withoutPassword = false): User
    {
        $user = new User();
        $user->setFirstName('Firstname');
        $user->setLastName('Lastname');
        $user->setEmail('demo@demo.com');
        $user->setPassword('');
        if ($withoutPassword) {
            $user->setPassword('demo1234');
        }
        $user->setRoles(['ROLE_USER']);

        return $user;
    }

    private function getRequest(): SignUpRequest
    {
        $request = new SignUpRequest();
        $request->setFirstName('Firstname');
        $request->setLastName('Lastname');
        $request->setEmail('demo@demo.com');
        $request->setPassword('demo1234');
        $request->setConfirmPassword('demo1234');

        return $request;
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->hasher = $this->createMock(UserPasswordHasherInterface::class);
        $this->userRepository = $this->createMock(UserRepository::class);
        $this->successHandler = $this->createMock(AuthenticationSuccessHandler::class);
    }
}
