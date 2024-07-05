<?php

namespace App\Module\Dish\Domain\Service;

use App\Module\Dish\Domain\Repository\ProductRepositoryInterface;
use App\Module\Dish\Domain\Entity\Product;

class ProductService implements ProductServiceInterface
{
    public function __construct(private readonly ProductRepositoryInterface $productRepository)
    {
    }

    public function getProductById($id): ?Product
    {
        return $this->productRepository->find($id);
    }

    public function getAllProducts(): array
    {
        return $this->productRepository->findAllProducts();
    }

    public function saveProduct(Product $product): void
    {
        $this->productRepository->save($product);
    }

    public function deleteProduct(Product $product): void
    {
        $this->productRepository->delete($product);
    }
}
