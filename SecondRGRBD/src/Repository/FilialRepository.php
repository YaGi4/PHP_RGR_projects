<?php

namespace App\Repository;

use App\Entity\Filial;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Filial>
 *
 * @method Filial|null find($id, $lockMode = null, $lockVersion = null)
 * @method Filial|null findOneBy(array $criteria, array $orderBy = null)
 * @method Filial[]    findAll()
 * @method Filial[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FilialRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Filial::class);
    }

    public function findAllFilials(): array
    {
            $entityManager = $this->getEntityManager();
    
            $query = $entityManager->createQuery(
                'SELECT p FROM App\Entity\Filial p'
            );
            return $query->getResult();
    }

    public function delete(int $id): void
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'DELETE FROM App\Entity\Filial p WHERE p.id = :id '
        )->setParameter('id', $id);
        $query->getResult();
    }
}
