<?php

namespace App\Repository;

use App\Entity\CheckIn;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CheckIn>
 *
 * @method CheckIn|null find($id, $lockMode = null, $lockVersion = null)
 * @method CheckIn|null findOneBy(array $criteria, array $orderBy = null)
 * @method CheckIn[]    findAll()
 * @method CheckIn[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CheckInRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CheckIn::class);
    }
    public function findByIdAndSettlementDate(int $id, string $dateTime): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT p FROM App\Entity\CheckIn p WHERE p.SettlementDate > :time AND p.BookingCode = :id '
        )
            ->setParameter('time', $dateTime)
            ->setParameter('id', $id);
        return $query->getResult();
    }
    public function delete(int $id): void
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'DELETE FROM App\Entity\CheckIn p WHERE p.id = :id '
        )->setParameter('id', $id);
        $query->getResult();
    }
    public function deleteByBookingId(int $id): void
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'DELETE FROM App\Entity\CheckIn p WHERE p.BookingCode = :id '
        )->setParameter('id', $id);
        $query->getResult();
    }

    public function deleteAllCheckInByClientId(int $id): void
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'DELETE FROM App\Entity\CheckIn p WHERE p.ClientCode = :id '
        )->setParameter('id', $id);
        $query->getResult();
    }
    public function deleteCheckInByRoomId(int $id): void
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'DELETE FROM App\Entity\CheckIn p WHERE p.RoomCode = :id '
        )->setParameter('id', $id);
        $query->getResult();
    }
}
