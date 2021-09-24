<?php

namespace App\Repository;

use App\Entity\Newscast;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Newscast|null find($id, $lockMode = null, $lockVersion = null)
 * @method Newscast|null findOneBy(array $criteria, array $orderBy = null)
 * @method Newscast[]    findAll()
 * @method Newscast[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NewscastRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Newscast::class);
    }

    // /**
    //  * @return Newscast[] Returns an array of Newscast objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('n.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Newscast
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
