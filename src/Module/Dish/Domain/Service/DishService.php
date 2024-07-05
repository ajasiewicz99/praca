<?php

namespace App\Module\Dish\Domain\Service;

use App\Module\Dish\Domain\Entity\DishProduct;
use App\Module\Dish\Domain\Repository\DishRepositoryInterface;
use App\Module\Dish\Domain\Entity\Dish;

class DishService implements DishServiceInterface
{
    public function __construct(private readonly DishRepositoryInterface $dishRepository)
    {
    }

    public function getDishById($id): ?Dish
    {
        $dish = $this->dishRepository->find($id);
        if ($dish === null) {
            return null;
        }
        $macros = $dish->calculateMacros();
        $dish->macros = $macros;

        return $dish;
    }

    public function getAllDishes(): array
    {
        $dishes =  $this->dishRepository->findAllDishes();
        /** @var Dish $dish */
        foreach ($dishes as $dish) {
            $macros = $dish->calculateMacros();
            $dish->macros = $macros;
        }

        return $dishes;
    }

    public function saveDish(Dish $dish, array $products): void
    {
        if($products) {
            foreach ($products as $product) {
                $dishProduct = new DishProduct();
                $dishProduct->setProduct($product['product']);
                $dishProduct->setDish($dish);
                $dishProduct->setGrams($product['grams']);

                $dish->addDishProduct($dishProduct);
            }
        }
        $this->dishRepository->save($dish);
    }

    public function deleteDish(Dish $dish): void
    {
        $this->dishRepository->delete($dish);
    }

    public function getPublicDishes(): array
    {
        return $this->dishRepository->findPublicDishes();
    }
}
