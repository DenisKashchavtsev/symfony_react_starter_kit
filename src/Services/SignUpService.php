<?php

namespace App\Services;

use App\Entity\User;
use App\Model\Request\SignupRequest;
use App\Repository\UserRepository;
use Exception;
use Lexik\Bundle\JWTAuthenticationBundle\Security\Http\Authentication\AuthenticationSuccessHandler;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

readonly class SignUpService
{
    public function __construct(private UserPasswordHasherInterface  $hasher,
                                private UserRepository               $userRepository,
                                private AuthenticationSuccessHandler $successHandler)
    {
    }

    public function signUp(SignUpRequest $signUpRequest): \Lexik\Bundle\JWTAuthenticationBundle\Response\JWTAuthenticationSuccessResponse|\Symfony\Component\HttpFoundation\Response
    {
        if ($this->userRepository->existsByEmail($signUpRequest->getEmail())) {
            throw new Exception('UserAlreadyExistsException');
        }

        $user = (new User())
            ->setRoles(['ROLE_USER'])
            ->setFirstName($signUpRequest->getFirstName())
            ->setLastName($signUpRequest->getLastName())
            ->setEmail($signUpRequest->getEmail());

        $user->setPassword($this->hasher->hashPassword($user, $signUpRequest->getPassword()));

        $this->userRepository->saveAndCommit($user);

        return $this->successHandler->handleAuthenticationSuccess($user);
    }
}