<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function findByOverThan($value)
    {
        return $this
            ->createQueryBuilder('u')
            ->addSelect('m')
            ->InnerJoin('u.messages', 'm')
            ->andWhere('m.price > :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->getQuery()
            ->getResult()
            ;
    }

    /**
     * @param int[] $idList
     * @return int|mixed|string|null
     */
    public function findUsingSubQuery(array $idList)
    {
        $retValue = null;
        $subQuery = $this
            ->createQueryBuilder("m_sub")
            ->select("m_sub.id")
            ->where("m_sub.id IN (:idList)")
            ->setParameter("idList", $idList);
        $temp = $subQuery->getQuery()->getResult();
        if (count($temp) >0){
            $retValue = $this
                ->createQueryBuilder("m")
                ->where("m.id IN (:subQueryIdList)")
                ->setParameter("subQueryIdList", $temp)
                ->getQuery()
                ->getResult();
        }
        return $retValue;
    }

    // /**
    //  * @return User[] Returns an array of User objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?User
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

}
