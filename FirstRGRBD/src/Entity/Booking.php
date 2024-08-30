<?php

namespace App\Entity;

use App\Repository\BookingRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BookingRepository::class)]
#[ORM\Table( name: 'booking')]
class Booking
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'booking_code')]
    private ?int $id = null;

    #[ORM\Column(name: 'room_code')]
    private ?int $RoomCode = null;

    #[ORM\Column(name: 'client_code')]
    private ?int $ClientCode = null;

    #[ORM\Column(name: 'booking_date', type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $BookingDate = null;

    #[ORM\Column(name: 'start_date', type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $StartDate = null;

    #[ORM\Column(name: 'expiration_date', type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $ExpirationDate = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getBookingDate(): ?\DateTimeInterface
    {
        return $this->BookingDate;
    }

    public function setBookingDate(\DateTimeInterface $BookingDate): static
    {
        $this->BookingDate = $BookingDate;

        return $this;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->StartDate;
    }

    public function setStartDate(\DateTimeInterface $StartDate): static
    {
        $this->StartDate = $StartDate;

        return $this;
    }

    public function getExpirationDate(): ?\DateTimeInterface
    {
        return $this->ExpirationDate;
    }

    public function setExpirationDate(\DateTimeInterface $ExpirationDate): static
    {
        $this->ExpirationDate = $ExpirationDate;

        return $this;
    }
}
