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
    }

    public function findBySearch(String $value)
    {
        return  $this->createQueryBuilder('d')
            ->andWhere('d.title LIKE :value')
            ->orWhere('d.description LIKE :valueDesc')
            ->setParameter('value','%'.$value.'%')
            ->setParameter('valueDesc','%'.$value.'%')
            ->getQuery()
            ->getResult();
    }

    public function findMaxDegreeByUser(int $user_id)
    {
        return $this->createQueryBuilder('d')
            ->select('MAX(d.degree) as maxDegree')
            ->join('d.user', 'u')
            ->andWhere('u.id = :id')
            ->setParameter('id', $user_id)
            ->getQuery()
            ->getResult();
    }

    public function findMoyenneDegreeByUser(int $user_id)
    {
        $date = new DateTime('now');
        $date->sub(new DateInterval('P1Y'));

        return $this->createQueryBuilder('d')
            ->select('AVG(d.degree) as moyDegree')
            ->join('d.user', 'u')
            ->andWhere('u.id = :id')
            ->andWhere('d.creationDate >= :date')
            ->setParameter('date', $date)
            ->setParameter('id', $user_id)
            ->getQuery()
            ->getResult();
    }

    public function findHowManyHotByUser(int $user_id, int $hotValue)
    {
        return $this->createQueryBuilder('d')
            ->select('COUNT(d) as nbHot')
            ->join('d.user', 'u')
            ->andWhere('u.id = :id')
            ->andWhere('d.degree >= :degree')
            ->setParameter('degree', $hotValue)
            ->setParameter('id', $user_id)
            ->getQuery()
            ->getResult();
    }
}
