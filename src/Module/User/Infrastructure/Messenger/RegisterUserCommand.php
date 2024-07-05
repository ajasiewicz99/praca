<?php

namespace App\Module\User\Infrastructure\Messenger;

class RegisterUserCommand
{
    public function __construct(
        private string $email,
        private string $password,
        private array $roles = ['ROLE_USER']
    ) {}

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getRoles(): array
    {
        return $this->roles;
    }
}
