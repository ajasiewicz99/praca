<?php

namespace App\Module\Dish\Infrastructure\Persistence\Doctrine\Repository;

use App\Module\Dish\Domain\Entity\Dish;
use App\Module\Dish\Domain\Repository\DishRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

class DishDoctrineRepository extends ServiceEntityRepository implements DishRepositoryInterface
{
    public function __construct(ManagerRegistry $registry, private EntityManagerInterface $entityManager)
    {
        parent::__construct($registry, Dish::class);
    }

    public function find($id, $lockMode = null, $lockVersion = null): ?Dish
    {
        return parent::find($id, $lockMode, $lockVersion);
    }

    public function findAllDishes(): array
    {
        return $this->createQueryBuilder('d')
            ->leftJoin('d.dishProducts', 'dp')
            ->addSelect('dp')
            ->getQuery()->getResult();
    }

    public function save(Dish $dish): void
    {
        $this->entityManager->persist($dish);
        $this->entityManager->flush();
    }

    public function delete(Dish $dish): void
    {
        $this->entityManager->remove($dish);
        $this->entityManager->flush();
    }

    public function findPublicDishes(): array
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.isPublic = :isPublic')
            ->setParameter('isPublic', true)
            ->getQuery()
            ->getResult();
    }
}
