<?php

namespace App\Entity;

use App\Repository\RoomRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RoomRepository::class)]
#[ORM\Table( name: 'room')]
class Room
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'room_code')]
    private ?int $id = null;

    #[ORM\Column(name: 'room_number')]
    private ?int $RoomNumber = null;

    #[ORM\Column(name: 'price')]
    private ?float $Price = null;

    #[ORM\Column(name: 'number_of_persons')]
    private ?int $NumberOfPersons = null;

    #[ORM\Column(name: 'room_type_code')]
    private ?int $RoomTypeCode = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRoomNumber(): ?int
    {
        return $this->RoomNumber;
    }

    public function setRoomNumber(int $RoomNumber): static
    {
        $this->RoomNumber = $RoomNumber;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->Price;
    }

    public function setPrice(float $Price): static
    {
        $this->Price = $Price;

        return $this;
    }

    public function getNumberOfPersons(): ?int
    {
        return $this->NumberOfPersons;
    }

    public function setNumberOfPersons(int $NumberOfPersons): static
    {
        $this->NumberOfPersons = $NumberOfPersons;

        return $this;
    }

    public function getRoomTypeCode(): ?int
    {
        return $this->RoomTypeCode;
    }

    public function setRoomTypeCode(int $RoomTypeCode): static
    {
        $this->RoomTypeCode = $RoomTypeCode;

        return $this;
    }
}
