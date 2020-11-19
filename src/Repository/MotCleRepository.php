<?php

namespace App\Repository;

use App\Entity\MotCle;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MotCle|null find($id, $lockMode = null, $lockVersion = null)
 * @method MotCle|null findOneBy(array $criteria, array $orderBy = null)
 * @method MotCle[]    findAll()
 * @method MotCle[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MotCleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MotCle::class);
    }

    //
}
