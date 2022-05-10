<?php

namespace App\Repository;

use App\Entity\PlayableClassItems;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PlayableClassItems>
 *
 * @method PlayableClassItems|null find($id, $lockMode = null, $lockVersion = null)
 * @method PlayableClassItems|null findOneBy(array $criteria, array $orderBy = null)
 * @method PlayableClassItems[]    findAll()
 * @method PlayableClassItems[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlayableClassItemsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PlayableClassItems::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(PlayableClassItems $entity, bool $flush = false): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(PlayableClassItems $entity, bool $flush = false): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

//    /**
//     * @return PlayableClassItems[] Returns an array of PlayableClassItems objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?PlayableClassItems
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
