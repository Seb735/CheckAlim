<?php

namespace App\Repository;

use App\Entity\Preservation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Preservation|null find($id, $lockMode = null, $lockVersion = null)
 * @method Preservation|null findOneBy(array $criteria, array $orderBy = null)
 * @method Preservation[]    findAll()
 * @method Preservation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PreservationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Preservation::class);
    }

    // /**
    //  * @return Preservation[] Returns an array of Preservation objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Preservation
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
