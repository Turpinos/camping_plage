<?php

namespace App\Repository;

use App\Entity\AccesPmr;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<AccesPmr>
 *
 * @method AccesPmr|null find($id, $lockMode = null, $lockVersion = null)
 * @method AccesPmr|null findOneBy(array $criteria, array $orderBy = null)
 * @method AccesPmr[]    findAll()
 * @method AccesPmr[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AccesPmrRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AccesPmr::class);
    }

//    /**
//     * @return AccesPmr[] Returns an array of AccesPmr objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('a.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?AccesPmr
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
