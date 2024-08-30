<?php

namespace App\Repository;

use App\Entity\Agreement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Agreement>
 *
 * @method Agreement|null find($id, $lockMode = null, $lockVersion = null)
 * @method Agreement|null findOneBy(array $criteria, array $orderBy = null)
 * @method Agreement[]    findAll()
 * @method Agreement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AgreementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Agreement::class);
    }
    public function findAllAgreements(): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT p FROM App\Entity\Agreement p'
        );
        return $query->getResult();
    }
    public function deleteByAgentId(int $id): void
    {
            $entityManager = $this->getEntityManager();

            $query = $entityManager->createQuery(
                'DELETE FROM App\Entity\Agreement p WHERE p.codeAgent = :id '
            )->setParameter('id', $id);
            $query->getResult();
    }
    public function delete(int $id): void
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'DELETE FROM App\Entity\Agreement p WHERE p.id = :id '
        )->setParameter('id', $id);
        $query->getResult();
    }
    public function findByTypeId(int $id): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT p FROM App\Entity\Agreement p WHERE p.codeInsuranceType = :id'
        )->setParameter('id', $id);
        return $query->getResult();
    }
}
