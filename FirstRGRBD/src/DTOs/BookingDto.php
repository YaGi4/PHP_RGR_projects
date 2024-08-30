<?php

namespace App\DTOs;

use App\Entity\Booking;
use App\Entity\Client;
use App\Entity\Room;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\EntityManagerInterface;

class BookingDto
{
    public ?int $id = null;
    public ?int $RoomCode = null;
    public ?int $ClientCode = null;
    public ?\DateTimeInterface $BookingDate = null;
    public ?\DateTimeInterface $StartDate = null;
    public ?\DateTimeInterface $ExpirationDate = null;
    public ?int $RoomNumber = null;
    public ?string $ClientName = null;

    public function __construct(int $id, int $RoomCode, int $ClientCode, \DateTimeInterface $BookingDate,
                                \DateTimeInterface $StartDate, \DateTimeInterface $ExpirationDate,
                                int $RoomNumber, string $ClientName)
    {
        $this->id = $id;
        $this->RoomCode = $RoomCode;
        $this->ClientCode = $ClientCode;
        $this->BookingDate = $BookingDate;
        $this->StartDate = $StartDate;
        $this->ExpirationDate = $ExpirationDate;
        $this->RoomNumber = $RoomNumber;
        $this->ClientName = $ClientName;
    }

    public static function createFromEntity(EntityManagerInterface $entityManager, Booking $bookingEntity): self
    {
        return new BookingDto(
            $bookingEntity->getId(),
            $bookingEntity->getRoomCode(),
            $bookingEntity->getClientCode(),
            $bookingEntity->getBookingDate(),
            $bookingEntity->getStartDate(),
            $bookingEntity->getExpirationDate(),
            $entityManager->getRepository(Room::class)->find($bookingEntity->getRoomCode())->getRoomNumber(),
            $entityManager->getRepository(Client::class)->find($bookingEntity->getClientCode())->getName()
        );
    }

    public static function createFromEntities(EntityManagerInterface $entityManager, array $bookingEntity): array
    {
        $bookings = [];
        for($i = 0; $i < count($bookingEntity); $i++){
            $bookings[$i] = new BookingDto(
                $bookingEntity[$i]->getId(),
                $bookingEntity[$i]->getRoomCode(),
                $bookingEntity[$i]->getClientCode(),
                $bookingEntity[$i]->getBookingDate(),
                $bookingEntity[$i]->getStartDate(),
                $bookingEntity[$i]->getExpirationDate(),
                $entityManager->getRepository(Room::class)->find($bookingEntity[$i]->getRoomCode())->getRoomNumber(),
                $entityManager->getRepository(Client::class)->find($bookingEntity[$i]->getClientCode())->getName()
            );
        }
        return $bookings;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getRoomCode(): ?int
    {
        return $this->RoomCode;
    }

    public function setRoomCode(?int $RoomCode): void
    {
        $this->RoomCode = $RoomCode;
    }

    public function getClientCode(): ?int
    {
        return $this->ClientCode;
    }

    public function setClientCode(?int $ClientCode): void
    {
        $this->ClientCode = $ClientCode;
    }

    public function getBookingDate(): ?\DateTimeInterface
    {
        return $this->BookingDate;
    }

    public function getBookingDateInString(): ?string
    {
        return $this->BookingDate->format('Y-m-d H:i:s');
    }

    public function setBookingDate(?\DateTimeInterface $BookingDate): void
    {
        $this->BookingDate = $BookingDate;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->StartDate;
    }

    public function getStartDateInString(): ?string
    {
        return $this->StartDate->format('Y-m-d H:i:s');
    }

    public function setStartDate(?\DateTimeInterface $StartDate): void
    {
        $this->StartDate = $StartDate;
    }

    public function getExpirationDate(): ?\DateTimeInterface
    {
        return $this->ExpirationDate;
    }

    public function getExpirationDateInString(): ?string
    {
        return $this->ExpirationDate->format('Y-m-d H:i:s');
    }

    public function setExpirationDate(?\DateTimeInterface $ExpirationDate): void
    {
        $this->ExpirationDate = $ExpirationDate;
    }
}