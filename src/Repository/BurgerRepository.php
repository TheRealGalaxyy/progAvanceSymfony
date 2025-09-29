<?php

namespace App\Repository;

use App\Entity\Burger;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Burger>
 */
class BurgerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Burger::class);
    }

    public function findByIngredient(string $ingredientField, string $ingredientName): array
    {
        $dql = "SELECT b
                FROM App\Entity\Burger b
                JOIN b.$ingredientField i
                WHERE i.name = :name";

        return $this->getEntityManager()
            ->createQuery($dql)
            ->setParameter('name', $ingredientName)
            ->getResult();
    }

    public function fiveBurgersByPrice(): array
    {
        $dql = "SELECT b FROM App\Entity\Burger b ORDER BY b.price DESC";

        return $this->getEntityManager()
            ->createQuery($dql)
            ->setMaxResults(5)
            ->getResult();
    }

    //    /**
    //     * @return Burger[] Returns an array of Burger objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('b')
    //            ->andWhere('b.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('b.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Burger
    //    {
    //        return $this->createQueryBuilder('b')
    //            ->andWhere('b.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
