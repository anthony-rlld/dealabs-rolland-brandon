<?php

namespace App\Repository;

use App\Entity\Deal;
use DateInterval;
use DateTime;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\VarDumper\Cloner\Data;
use Symfony\Component\HttpFoundation\Response;

/**
 * @method Deal|null find($id, $lockMode = null, $lockVersion = null)
 * @method Deal|null findOneBy(array $criteria, array $orderBy = null)
 * @method Deal[]    findAll()
 * @method Deal[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DealRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Deal::class);
    }

    public function findLesPlusHot(int $hotValue)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.degree >= :degree')
            ->setParameter('degree', $hotValue)
            ->setMaxResults(10)
            ->getQuery()
            ->getResult();
    }

    public function findALaUne()
    {
        $date = new DateTime('now');
        $date->sub(new DateInterval('P7D'));

        return $this->createQueryBuilder('d')
            ->andWhere('d.creationDate >= :date')
            ->setParameter('date', $date)
            ->setMaxResults(10)
            ->getQuery()
            ->getResult();

    public function findBySearch(String $value)
    {

        return $queryBuilder = $this->createQueryBuilder('d')
                                    ->andWhere('d.title LIKE :value')
                                    ->orWhere('d.description LIKE :valueDesc')
                                    ->setParameter('value','%'.$value.'%')
                                    ->setParameter('valueDesc','%'.$value.'%')
                                    ->getQuery()
                                    ->getResult();
    }

    // /**
    //  * @return Deal[] Returns an array of Deal objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Deal
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
