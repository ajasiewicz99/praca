<?php

namespace App\Module\Dish\Domain\Repository;

use App\Module\Dish\Domain\Entity\Product;

interface ProductRepositoryInterface
{
    public function find($id): ?Product;
    public function findAllProducts(): array;
    public function save(Product $product): void;
    public function delete(Product $product): void;
}
