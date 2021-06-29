<?php

namespace App\Repository;

use App\Entity\Lines;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Lines|null find($id, $lockMode = null, $lockVersion = null)
 * @method Lines|null findOneBy(array $criteria, array $orderBy = null)
 * @method Lines[]    findAll()
 * @method Lines[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LinesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Lines::class);
    }

    public function findFeedbacksById(int $value)
    {


        // return $this->createQueryBuilder('l')
        //     ->select('f.rate', 'f.date', 'f.comment')
        //     ->from('lines', 'l')
        //     ->innerJoin('l', 'feedbacks', 'f', 'l.id = f.line')
        //     ->where("f.line = {$value}");
    }

    // /**
    //  * @return Lines[] Returns an array of Lines objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Lines
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
