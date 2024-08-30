<?php

namespace App\Repository;

use App\Entity\InsuranceType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<InsuranceType>
 *
 * @method InsuranceType|null find($id, $lockMode = null, $lockVersion = null)
 * @method InsuranceType|null findOneBy(array $criteria, array $orderBy = null)
 * @method InsuranceType[]    findAll()
 * @method InsuranceType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InsuranceTypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, InsuranceType::class);
    }
    public function findAllInsuranceType(): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT p FROM App\Entity\InsuranceType p'
        );
        return $query->getResult();
    }
    public function delete(int $id): void
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'DELETE FROM App\Entity\InsuranceType p WHERE p.id = :id '
        )->setParameter('id', $id);
        $query->getResult();
    }
}
