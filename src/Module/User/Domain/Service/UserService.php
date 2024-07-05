<?php

namespace App\Module\User\Domain\Service;

use App\Module\User\Domain\Entity\User;
use App\Module\User\Domain\Repository\UserRepositoryInterface;

class UserService
{
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function registerUser(User $user): void
    {
        if ($this->userRepository->findByEmail($user->getEmail()) !== null) {
            throw new \DomainException('User with this email already exists');
        }
        $this->userRepository->save($user);
    }
}
