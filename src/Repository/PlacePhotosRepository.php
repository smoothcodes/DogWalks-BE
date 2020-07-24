<?php

namespace App\Repository;

use App\Entity\PlacePhotos;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PlacePhotos|null find($id, $lockMode = null, $lockVersion = null)
 * @method PlacePhotos|null findOneBy(array $criteria, array $orderBy = null)
 * @method PlacePhotos[]    findAll()
 * @method PlacePhotos[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlacePhotosRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PlacePhotos::class);
    }

    // /**
    //  * @return PlacePhotos[] Returns an array of PlacePhotos objects
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
    public function findOneBySomeField($value): ?PlacePhotos
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
