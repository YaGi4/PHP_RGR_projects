<?php

namespace App\DTOs;

use App\Entity\CheckIn;
use App\Entity\Client;
use App\Entity\Room;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\EntityManagerInterface;

class CheckInDto
{
    public ?int $id = null;
    public ?\DateTimeInterface $SettlementDate = null;
    public ?int $RoomCode = null;
    public ?int $ClientCode = null;
    public ?int $BookingCode = null;
    public ?string $Note = null;
    public ?\DateTimeInterface $DateOfRelease = null;
    public ?float $PaymentAmount = null;
    public ?int $RoomNumber = null;
    public ?string $ClientName = null;


    public function __construct(int $id, \DateTimeInterface $SettlementDate, int $RoomCode, int $ClientCode,
                                int $BookingCode, string $Note, \DateTimeInterface $DateOfRelease, float $PaymentAmount,
                                int $RoomNumber, string $ClientName)
    {
        $this->id = $id;
        $this->SettlementDate = $SettlementDate;
        $this->RoomCode = $RoomCode;
        $this->ClientCode = $ClientCode;
        $this->BookingCode = $BookingCode;
        $this->Note = $Note;
        $this->DateOfRelease = $DateOfRelease;
        $this->PaymentAmount = $PaymentAmount;
        $this->RoomNumber = $RoomNumber;
        $this->ClientName = $ClientName;
    }

    public static function createFromEntity(EntityManagerInterface $entityManager, CheckIn $checkInEntity): self
    {
        return new CheckInDto(
            $checkInEntity->getId(),
            $checkInEntity->getSettlementDate(),
            $checkInEntity->getRoomCode(),
            $checkInEntity->getClientCode(),
            $checkInEntity->getBookingCode(),
            $checkInEntity->getNote(),
            $checkInEntity->getDateOfRelease(),
            $checkInEntity->getPaymentAmount(),
            $entityManager->getRepository(Room::class)->find($checkInEntity->getRoomCode())->getRoomNumber(),
            $entityManager->getRepository(Client::class)->find($checkInEntity->getClientCode())->getName()
        );
    }

    public static function createFromEntities(EntityManagerInterface $entityManager, array $checkInEntity): array
    {
        $checkIns = [];
        for($i = 0; $i < count($checkInEntity); $i++){
            $checkIns[$i] = new CheckInDto(
                $checkInEntity[$i]->getId(),
                $checkInEntity[$i]->getSettlementDate(),
                $checkInEntity[$i]->getRoomCode(),
                $checkInEntity[$i]->getClientCode(),
                $checkInEntity[$i]->getBookingCode(),
                $checkInEntity[$i]->getNote(),
                $checkInEntity[$i]->getDateOfRelease(),
                $checkInEntity[$i]->getPaymentAmount(),
                $entityManager->getRepository(Room::class)->find($checkInEntity[$i]->getRoomCode())->getRoomNumber(),
                $entityManager->getRepository(Client::class)->find($checkInEntity[$i]->getClientCode())->getName()
            );
        }
        return $checkIns;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getSettlementDate(): ?\DateTimeInterface
    {
        return $this->SettlementDate;
    }
    public function getSettlementDateInString(): ?string
    {
        return $this->SettlementDate->format('Y-m-d H:i:s');
    }

    public function setSettlementDate(?\DateTimeInterface $SettlementDate): void
    {
        $this->SettlementDate = $SettlementDate;
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

    public function getBookingCode(): ?int
    {
        return $this->BookingCode;
    }

    public function setBookingCode(?int $BookingCode): void
    {
        $this->BookingCode = $BookingCode;
    }

    public function getNote(): ?string
    {
        return $this->Note;
    }

    public function setNote(?string $Note): void
    {
        $this->Note = $Note;
    }

    public function getDateOfRelease(): ?\DateTimeInterface
    {
        return $this->DateOfRelease;
    }

    public function getDateOfReleaseInString(): ?string
    {
        return $this->DateOfRelease->format('Y-m-d H:i:s');
    }

    public function setDateOfRelease(?\DateTimeInterface $DateOfRelease): void
    {
        $this->DateOfRelease = $DateOfRelease;
    }

    public function getPaymentAmount(): ?float
    {
        return $this->PaymentAmount;
    }

    public function setPaymentAmount(?float $PaymentAmount): void
    {
        $this->PaymentAmount = $PaymentAmount;
    }

}