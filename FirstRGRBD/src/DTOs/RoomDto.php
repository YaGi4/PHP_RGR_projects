<?php

namespace App\DTOs;

use App\Entity\Room;
use App\Entity\RoomType;
use Doctrine\ORM\EntityManagerInterface;

class RoomDto
{

    public ?int $id = null;
    public ?int $RoomNumber = null;
    public ?float $Price = null;
    public ?int $NumberOfPersons = null;
    public ?int $RoomTypeCode = null;
    public ?string $RoomTypeName = null;

    public function __construct(int $id, int $RoomNumber, float $Price, int $NumberOfPersons, int $RoomTypeCode, string $RoomTypeName)
    {
        $this->id = $id;
        $this->RoomNumber = $RoomNumber;
        $this->Price = $Price;
        $this->NumberOfPersons = $NumberOfPersons;
        $this->RoomTypeCode = $RoomTypeCode;
        $this->RoomTypeName = $RoomTypeName;
    }

    public static function createFromEntity(EntityManagerInterface $entityManager, Room $roomEntity): self
    {
        return new RoomDto(
            $roomEntity->getId(),
            $roomEntity->getRoomNumber(),
            $roomEntity->getPrice(),
            $roomEntity->getNumberOfPersons(),
            $roomEntity->getRoomTypeCode(),
            $entityManager->getRepository(RoomType::class)->find($roomEntity->getRoomTypeCode())->getTypeName()
        );
    }

    public static function createFromEntities(EntityManagerInterface $entityManager, array $roomEntity): array
    {
        $rooms = [];
        for($i = 0; $i < count($roomEntity); $i++){
            $rooms[$i] = new RoomDto(
                $roomEntity[$i]->getId(),
                $roomEntity[$i]->getRoomNumber(),
                $roomEntity[$i]->getPrice(),
                $roomEntity[$i]->getNumberOfPersons(),
                $roomEntity[$i]->getRoomTypeCode(),
                $entityManager->getRepository(RoomType::class)->find($roomEntity[$i]->getRoomTypeCode())->getTypeName()
            );
        }
        return $rooms;
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getRoomNumber(): ?int
    {
        return $this->RoomNumber;
    }

    public function setRoomNumber(?int $RoomNumber): void
    {
        $this->RoomNumber = $RoomNumber;
    }

    public function getPrice(): ?float
    {
        return $this->Price;
    }

    public function setPrice(?float $Price): void
    {
        $this->Price = $Price;
    }

    public function getNumberOfPersons(): ?int
    {
        return $this->NumberOfPersons;
    }

    public function setNumberOfPersons(?int $NumberOfPersons): void
    {
        $this->NumberOfPersons = $NumberOfPersons;
    }

    public function getRoomTypeCode(): ?int
    {
        return $this->RoomTypeCode;
    }

    public function setRoomTypeCode(?int $RoomTypeCode): void
    {
        $this->RoomTypeCode = $RoomTypeCode;
    }
    public function getRoomTypeName(): ?string
    {
        return $this->RoomTypeName;
    }

    public function setRoomTypeName(?string $RoomTypeName): void
    {
        $this->RoomTypeName = $RoomTypeName;
    }
}