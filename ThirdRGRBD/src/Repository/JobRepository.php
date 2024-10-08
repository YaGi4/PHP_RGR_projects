<?php

namespace App\Repository;

use App\Entity\Job;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Job>
 *
 * @method Job|null find($id, $lockMode = null, $lockVersion = null)
 * @method Job|null findOneBy(array $criteria, array $orderBy = null)
 * @method Job[]    findAll()
 * @method Job[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class JobRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Job::class);
    }

    public function delete(int $id): void
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'DELETE FROM App\Entity\Job p WHERE p.id = :id '
        )->setParameter('id', $id);
        $query->getResult();
    }
    public function findByTypeId(int $id): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT p FROM App\Entity\Job p WHERE p.idTypeWork = :id '
        )
            ->setParameter('id', $id);
        return $query->getResult();
    }

}
