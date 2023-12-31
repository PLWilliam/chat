<?php

namespace App\Repository;

use App\Entity\GlobalMessage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<GlobalMessage>
 *
 * @method GlobalMessage|null find($id, $lockMode = null, $lockVersion = null)
 * @method GlobalMessage|null findOneBy(array $criteria, array $orderBy = null)
 * @method GlobalMessage[]    findAll()
 * @method GlobalMessage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GlobalMessageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GlobalMessage::class);
    }

//    /**
//     * @return GlobalMessage[] Returns an array of GlobalMessage objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('g')
//            ->andWhere('g.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('g.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?GlobalMessage
//    {
//        return $this->createQueryBuilder('g')
//            ->andWhere('g.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
