<?php

namespace App\Repository;

use App\Entity\Refund;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\DBAL\DBALException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Refund|null find($id, $lockMode = null, $lockVersion = null)
 * @method Refund|null findOneBy(array $criteria, array $orderBy = null)
 * @method Refund[]    findAll()
 * @method Refund[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RefundRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Refund::class);
    }

    // /**
    //  * @return Refund[] Returns an array of Refund objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Refund
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function getCreatedTime() {
        $conn = $this->getEntityManager()->getConnection();

        $sql = 'SELECT created_at FROM refund';

        $stmt = $conn->prepare($sql);
        try {
            $stmt->execute();
        } catch (DBALException $e) {
        }

        return $stmt->fetchAll();
    }

    public function getByStatus($status) {
        $conn = $this->getEntityManager()->getConnection();
        $sql = 'SELECT * FROM refund 
                WHERE refund.status= :status';

        $stmt = $conn->prepare($sql);
        $stmt->execute(['status'=>$status]);

        return $stmt->fetchAll();
    }

}
