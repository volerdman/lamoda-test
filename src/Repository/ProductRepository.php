<?php

namespace App\Repository;

use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Product>
 *
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    public function findByStorageId(int $storageId)
    {
        return $this->createQueryBuilder('p')
            ->where('p.storageId = :storageId')
            ->setParameter('storageId', $storageId)
            ->getQuery()
            ->getResult();
    }

    public function reserveProductsByCodes(array $codes): array
    {
        $this->createQueryBuilder('p')
            ->update()
            ->set('p.reserved', 'true')
            ->where('p.code IN (:codes)')
            ->setParameter('codes', $codes)
            ->getQuery()
            ->getResult();


        return $this->createQueryBuilder('p')
            ->where('p.code IN (:codes)')
            ->andWhere('p.reserved = 1')
            ->setParameter('codes', $codes)
            ->getQuery()
            ->getArrayResult();
    }

    public function cancelReservationProductsByCodes(array $codes): array
    {
        $this->createQueryBuilder('p')
            ->update()
            ->set('p.reserved', 'false')
            ->where('p.code IN (:codes)')
            ->setParameter('codes', $codes)
            ->getQuery()
            ->getResult();

        return $this->createQueryBuilder('p')
            ->where('p.code IN (:codes)')
            ->andWhere('p.reserved = :reserved')
            ->setParameter('codes', $codes)
            ->setParameter('reserved', 0)
            ->getQuery()
            ->getArrayResult();
    }
}
