<?php

namespace App\Module\Dish\Domain\Repository;

use App\Module\Dish\Domain\Entity\Dish;

interface DishRepositoryInterface
{
    public function find($id): ?Dish;
    public function findAllDishes(): array;
    public function save(Dish $dish): void;
    public function delete(Dish $dish): void;
    public function findPublicDishes(): array;
}
