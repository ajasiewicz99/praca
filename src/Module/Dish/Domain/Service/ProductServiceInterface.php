<?php

namespace App\Module\Dish\Domain\Service;

use App\Module\Dish\Domain\Entity\Product;

interface ProductServiceInterface
{
    public function getProductById($id): ?Product;
    public function getAllProducts(): array;
    public function saveProduct(Product $product): void;
    public function deleteProduct(Product $product): void;
}
