<?php

namespace App\Repository;

use App\Entity\Scholarship;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Scholarship>
 *
 * @method Scholarship|null find($id, $lockMode = null, $lockVersion = null)
 * @method Scholarship|null findOneBy(array $criteria, array $orderBy = null)
 * @method Scholarship[]    findAll()
 * @method Scholarship[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ScholarshipRepository extends BaseRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Scholarship::class);
    }

    public function save(Scholarship $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Scholarship $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
