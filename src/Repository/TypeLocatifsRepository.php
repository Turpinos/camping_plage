<?php

namespace App\Repository;

use App\Entity\TypeLocatifs;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TypeLocatifs>
 *
 * @method TypeLocatifs|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeLocatifs|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeLocatifs[]    findAll()
 * @method TypeLocatifs[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeLocatifsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypeLocatifs::class);
    }

//    /**
//     * @return TypeLocatifs[] Returns an array of TypeLocatifs objects
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

//    public function findOneBySomeField($value): ?TypeLocatifs
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
