<?php

namespace App\Repository;

use App\Entity\Ouvertures;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Ouvertures>
 *
 * @method Ouvertures|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ouvertures|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ouvertures[]    findAll()
 * @method Ouvertures[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OuverturesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ouvertures::class);
    }

//    /**
//     * @return Ouvertures[] Returns an array of Ouvertures objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('o')
//            ->andWhere('o.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('o.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Ouvertures
//    {
//        return $this->createQueryBuilder('o')
//            ->andWhere('o.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
