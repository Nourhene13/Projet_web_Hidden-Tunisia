<?php

namespace App\Repository;

use App\Entity\Reservations;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Reservations>
 *
 * @method Reservations|null find($id, $lockMode = null, $lockVersion = null)
 * @method Reservations|null findOneBy(array $criteria, array $orderBy = null)
 * @method Reservations[]    findAll()
 * @method Reservations[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReservationsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Reservations::class);
    }

    public function save(Reservations $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Reservations $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
    public function sortByAscDate(): array
    {
        return $this->createQueryBuilder('c')
            ->orderBy('c.horaireC', 'ASC')
            ->getQuery()
            ->getResult();
    }

    public function sortByDescDate(): array
    {
        return $this->createQueryBuilder('c')
            ->orderBy('c.horaireC', 'DESC')
            ->getQuery()
            ->getResult();
    }

    /**
     * @return Reservations[] Returns an array of Reservations objects
     */
    public function findOneByEvenement($value): array
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.evenement = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(100)
            ->getQuery()
            ->getResult();
    }
    /*public function triertitreev()
    {
        $queryBuilder = $this->createQueryBuilder('i')
            ->orderBy('i.titre_evenement', 'ASC')
            ->getQuery()
            ->getResult();
        return $queryBuilder;
    }*/





    public function trierdateev()
    {
        $queryBuilder = $this->createQueryBuilder('i')
            ->orderBy('i.date_res', 'ASC')
            ->getQuery()
            ->getResult();
        return $queryBuilder;
    }

    //    public function findOneBySomeField($value): ?Reservations
    //    {
    //        return $this->createQueryBuilder('r')
    //            ->andWhere('r.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
