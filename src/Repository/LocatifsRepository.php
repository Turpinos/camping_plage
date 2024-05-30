<?php

namespace App\Repository;

use App\Entity\Locatifs;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Locatifs>
 *
 * @method Locatifs|null find($id, $lockMode = null, $lockVersion = null)
 * @method Locatifs|null findOneBy(array $criteria, array $orderBy = null)
 * @method Locatifs[]    findAll()
 * @method Locatifs[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LocatifsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Locatifs::class);
    }

//    /**
//     * @return Locatifs[] Returns an array of Locatifs objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('l.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Locatifs
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
