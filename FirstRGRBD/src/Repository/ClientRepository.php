<?php

namespace App\Repository;

use App\Entity\Client;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Client>
 *
 * @method Client|null find($id, $lockMode = null, $lockVersion = null)
 * @method Client|null findOneBy(array $criteria, array $orderBy = null)
 * @method Client[]    findAll()
 * @method Client[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClientRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Client::class);
    }

    public function findAllClient(): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT p FROM App\Entity\Client p'
        );
        return $query->getResult();
    }
    public function deleteClient(int $id): void
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'DELETE FROM App\Entity\Client p WHERE p.id = :id '
        )->setParameter('id', $id);
        $query->getResult();
    }

    public function findIDByParams(string $name, string $surname, string $patronymic, string $comm, string $pass): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT p FROM App\Entity\Client p WHERE p.Name = :name AND p.Surname = :surname AND p.Patronymic = :patronymic AND
             p.Commentary = :commentary AND p.PassportData = :passportData'
        )
            ->setParameter('name', $name)
            ->setParameter('surname', $surname)
            ->setParameter('patronymic', $patronymic)
            ->setParameter('commentary', $comm)
            ->setParameter('passportData', $pass);
        return $query->getResult();
    }
}
