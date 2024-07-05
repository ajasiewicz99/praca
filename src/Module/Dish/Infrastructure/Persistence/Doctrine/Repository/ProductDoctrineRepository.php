<?php

namespace App\Module\Dish\Infrastructure\Persistence\Doctrine\Repository;

use App\Module\Dish\Domain\Entity\Product;
use App\Module\Dish\Domain\Repository\ProductRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

class ProductDoctrineRepository extends ServiceEntityRepository implements ProductRepositoryInterface
{
    public function __construct(ManagerRegistry $registry, private EntityManagerInterface $entityManager)
    {
        parent::__construct($registry, Product::class);
    }

    public function find($id, $lockMode = null, $lockVersion = null): ?Product
    {
        return parent::find($id, $lockMode, $lockVersion);
    }

    public function findAllProducts(): array
    {
        return $this->findAll();
    }

    public function save(Product $product): void
    {
        $this->entityManager->persist($product);
        $this->entityManager->flush();
    }

    public function delete(Product $product): void
    {
        $this->entityManager->remove($product);
        $this->entityManager->flush();
    }
}
