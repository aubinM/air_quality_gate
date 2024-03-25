<?php

namespace App\Repository;

use App\Entity\ApiForm;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ApiForm>
 *
 * @method ApiForm|null find($id, $lockMode = null, $lockVersion = null)
 * @method ApiForm|null findOneBy(array $criteria, array $orderBy = null)
 * @method ApiForm[]    findAll()
 * @method ApiForm[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ApiFormRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ApiForm::class);
    }

    //    /**
    //     * @return ApiForm[] Returns an array of ApiForm objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('a')
    //            ->andWhere('a.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('a.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?ApiForm
    //    {
    //        return $this->createQueryBuilder('a')
    //            ->andWhere('a.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
