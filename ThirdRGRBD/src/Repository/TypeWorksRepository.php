<?php

namespace App\Repository;

use App\Entity\TypeWorks;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TypeWorks>
 *
 * @method TypeWorks|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeWorks|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeWorks[]    findAll()
 * @method TypeWorks[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeWorksRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypeWorks::class);
    }

    public function delete(int $id): void
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'DELETE FROM App\Entity\TypeWorks p WHERE p.id = :id '
        )->setParameter('id', $id);
        $query->getResult();
    }
}
