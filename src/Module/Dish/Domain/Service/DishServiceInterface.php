<?php

namespace App\Module\Dish\Domain\Service;

use App\Module\Dish\Domain\Entity\Dish;

interface DishServiceInterface
{
    public function getDishById($id): ?Dish;
    public function getAllDishes(): array;
    public function saveDish(Dish $dish, array $products): void;
    public function deleteDish(Dish $dish): void;
    public function getPublicDishes(): array;
}
