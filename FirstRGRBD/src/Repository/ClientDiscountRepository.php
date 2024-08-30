<?php

namespace App\Repository;

use App\Entity\ClientDiscount;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ClientDiscount>
 *
 * @method ClientDiscount|null find($id, $lockMode = null, $lockVersion = null)
 * @method ClientDiscount|null findOneBy(array $criteria, array $orderBy = null)
 * @method ClientDiscount[]    findAll()
 * @method ClientDiscount[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClientDiscountRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ClientDiscount::class);
    }
    public function findAllDiscountByClientId(int $id): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT p FROM App\Entity\ClientDiscount p WHERE p.ClientCode = :id '
        )->setParameter('id', $id);
        return $query->getResult();
    }
    public function deleteAllDiscountByClientId(int $id): void
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'DELETE FROM App\Entity\ClientDiscount p WHERE p.ClientCode = :id '
        )->setParameter('id', $id);
        $query->getResult();
    }
}
