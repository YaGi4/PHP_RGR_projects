<?php

namespace App\Entity;

use App\Repository\CheckInRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CheckInRepository::class)]
#[ORM\Table( name: 'check_in')]
class CheckIn
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'check_in_code')]
    private ?int $id = null;

    #[ORM\Column(name: 'settlement_date', type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $SettlementDate = null;

    #[ORM\Column(name: 'room_code')]
    private ?int $RoomCode = null;

    #[ORM\Column(name: 'client_code')]
    private ?int $ClientCode = null;

    #[ORM\Column(name: 'booking_code',)]
    private ?int $BookingCode = null;

    #[ORM\Column(name: 'note', length: 255)]
    private ?string $Note = null;

    #[ORM\Column(name: 'date_of_release', type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $DateOfRelease = null;

    #[ORM\Column(name: 'payment_amount')]
    private ?float $PaymentAmount = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSettlementDate(): ?\DateTimeInterface
    {
        return $this->SettlementDate;
    }

    public function setSettlementDate(\DateTimeInterface $SettlementDate): static
    {
        $this->SettlementDate = $SettlementDate;

        return $this;
    }

    public function getRoomCode(): ?int
    {
        return $this->RoomCode;
    }

    public function setRoomCode(int $RoomCode): static
    {
        $this->RoomCode = $RoomCode;

        return $this;
    }

    public function getClientCode(): ?int
    {
        return $this->ClientCode;
    }

    public function setClientCode(int $ClientCode): static
    {
        $this->ClientCode = $ClientCode;

        return $this;
    }

    public function getBookingCode(): ?int
    {
        return $this->BookingCode;
    }

    public function setBookingCode(int $BookingCode): static
    {
        $this->BookingCode = $BookingCode;

        return $this;
    }

    public function getNote(): ?string
    {
        return $this->Note;
    }

    public function setNote(string $Note): static
    {
        $this->Note = $Note;

        return $this;
    }

    public function getDateOfRelease(): ?\DateTimeInterface
    {
        return $this->DateOfRelease;
    }

    public function setDateOfRelease(\DateTimeInterface $DateOfRelease): static
    {
        $this->DateOfRelease = $DateOfRelease;

        return $this;
    }

    public function getPaymentAmount(): ?float
    {
        return $this->PaymentAmount;
    }

    public function setPaymentAmount(float $PaymentAmount): static
    {
        $this->PaymentAmount = $PaymentAmount;

        return $this;
    }
}
