<?php

namespace App\Repository;

use App\Entity\Booking;
use DateTimeImmutable;
use DateTimeInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Booking>
 *
 * @method Booking|null find($id, $lockMode = null, $lockVersion = null)
 * @method Booking|null findOneBy(array $criteria, array $orderBy = null)
 * @method Booking[]    findAll()
 * @method Booking[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BookingRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Booking::class);
    }

    public function delete(int $id): void
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'DELETE FROM App\Entity\Booking p WHERE p.id = :id '
        )->setParameter('id', $id);
        $query->getResult();
    }
    public function findByExpirationDate(string $dateTime): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT p FROM App\Entity\Booking p WHERE p.ExpirationDate > :time '
        )->setParameter('time', $dateTime);
        return $query->getResult();
    }
    public function deleteAllBookingByClientId(int $id): void
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'DELETE FROM App\Entity\Booking p WHERE p.ClientCode = :id '
        )->setParameter('id', $id);
        $query->getResult();
    }
    public function deleteBookingByRoomId(int $id): void
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'DELETE FROM App\Entity\Booking p WHERE p.RoomCode = :id '
        )->setParameter('id', $id);
        $query->getResult();
    }
}
