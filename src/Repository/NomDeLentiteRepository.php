<?php

namespace App\Repository;

use App\Entity\NomDeLentite;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<NomDeLentite>
 *
 * @method NomDeLentite|null find($id, $lockMode = null, $lockVersion = null)
 * @method NomDeLentite|null findOneBy(array $criteria, array $orderBy = null)
 * @method NomDeLentite[]    findAll()
 * @method NomDeLentite[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NomDeLentiteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NomDeLentite::class);
    }

    public function save(NomDeLentite $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(NomDeLentite $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return NomDeLentite[] Returns an array of NomDeLentite objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('n')
//            ->andWhere('n.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('n.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?NomDeLentite
//    {
//        return $this->createQueryBuilder('n')
//            ->andWhere('n.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
