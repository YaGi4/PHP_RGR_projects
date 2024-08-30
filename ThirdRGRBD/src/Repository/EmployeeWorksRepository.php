<?php

namespace App\Repository;

use App\Entity\EmployeeWorks;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<EmployeeWorks>
 *
 * @method EmployeeWorks|null find($id, $lockMode = null, $lockVersion = null)
 * @method EmployeeWorks|null findOneBy(array $criteria, array $orderBy = null)
 * @method EmployeeWorks[]    findAll()
 * @method EmployeeWorks[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EmployeeWorksRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EmployeeWorks::class);
    }

    public function findByEmployeeId(int $id): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT p FROM App\Entity\EmployeeWorks p WHERE p.idEmployee = :id '
        )
            ->setParameter('id', $id);
        return $query->getResult();
    }
    public function findByJobId(int $id): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT p FROM App\Entity\EmployeeWorks p WHERE p.idJob = :id '
        )
            ->setParameter('id', $id);
        return $query->getResult();
    }
    public function delete(int $id): void
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'DELETE FROM App\Entity\EmployeeWorks p WHERE p.id = :id '
        )->setParameter('id', $id);
        $query->getResult();
    }
}
