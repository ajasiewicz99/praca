<?php

namespace App\Module\User\Domain\Repository;

use App\Module\User\Domain\Entity\User;

interface UserRepositoryInterface
{
    public function save(User $user): void;

    public function findByEmail(string $email): ?User;
}
