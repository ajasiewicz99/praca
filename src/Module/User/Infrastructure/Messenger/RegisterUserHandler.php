<?php

namespace App\Module\User\Infrastructure\Messenger;

use App\Module\User\Domain\Entity\User;
use App\Module\User\Domain\Service\UserService;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class RegisterUserHandler
{
    public function __construct(private UserService $userService) {}

    public function __invoke(RegisterUserCommand $command): void
    {
        $user = new User($command->getEmail(), $command->getPassword(), $command->getRoles());
        $this->userService->registerUser($user);
    }
}
