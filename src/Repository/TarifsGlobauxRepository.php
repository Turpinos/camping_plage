<?php

namespace App\Repository;

use App\Entity\TarifsGlobaux;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TarifsGlobaux>
 *
 * @method TarifsGlobaux|null find($id, $lockMode = null, $lockVersion = null)
 * @method TarifsGlobaux|null findOneBy(array $criteria, array $orderBy = null)
 * @method TarifsGlobaux[]    findAll()
 * @method TarifsGlobaux[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TarifsGlobauxRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TarifsGlobaux::class);
    }

//    /**
//     * @return TarifsGlobaux[] Returns an array of TarifsGlobaux objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('t.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?TarifsGlobaux
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
