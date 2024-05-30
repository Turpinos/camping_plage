<?php

namespace App\Repository;

use App\Entity\CoordonneesMap;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CoordonneesMap>
 *
 * @method CoordonneesMap|null find($id, $lockMode = null, $lockVersion = null)
 * @method CoordonneesMap|null findOneBy(array $criteria, array $orderBy = null)
 * @method CoordonneesMap[]    findAll()
 * @method CoordonneesMap[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CoordonneesMapRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CoordonneesMap::class);
    }

//    /**
//     * @return CoordonneesMap[] Returns an array of CoordonneesMap objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?CoordonneesMap
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
