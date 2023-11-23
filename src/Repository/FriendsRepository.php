<?php

namespace App\Repository;

use App\Entity\User;
use App\Entity\Friends;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<Friends>
 *
 * @method Friends|null find($id, $lockMode = null, $lockVersion = null)
 * @method Friends|null findOneBy(array $criteria, array $orderBy = null)
 * @method Friends[]    findAll()
 * @method Friends[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FriendsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Friends::class);
    }

    public function getFriendsList(User $user){
        return $this->createQueryBuilder('f')
            ->where('f.friend1 = :uid')
            ->orWhere('f.friend2 = :fid')
            ->setParameter('uid', $user)
            ->setParameter('fid', $user)
            ->getQuery()
            ->getResult();
    }

    public function getFriendsListAccepted(User $user){
        return $this->createQueryBuilder('f')
            ->join('f.friendsRequest', 'r')
            ->where('f.friend1 = :uid')
            ->orWhere('f.friend2 = :fid')
            ->andWhere('f.privateMessage is NULL')
            ->andWhere('r.status = :rid')
            ->setParameter('uid', $user)
            ->setParameter('fid', $user)
            ->setParameter('rid', 'Accepted')
            ->getQuery()
            ->getResult();
    }

    public function getFriendsListMP(User $user){
        return $this->createQueryBuilder('f')
            ->where('f.friend1 = :uid')
            ->orWhere('f.friend2 = :fid')
            ->andWhere('f.privateMessage is not NULL')
            ->setParameter('uid', $user)
            ->setParameter('fid', $user)
            ->getQuery()
            ->getResult();
    }

    // public function checkIfFriendCanBeAdded($friend1,$friend2)
    // {
    //     if($friend2 !== $friend1->getEmail()){
    //         // return        
    //     }
        
    //     foreach ($friend1 as $key => $value) {
    //         $value->
    //     }

    // }

//    /**
//     * @return Friends[] Returns an array of Friends objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('f.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Friends
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
