<?php

namespace App\DTOs;

use App\Entity\RoomType;

class RoomTypeDto
{
    public ?int $id = null;
    public ?string $TypeName = null;
    public function __construct(int $id, string $typeName)
    {
        $this->id = $id;
        $this->TypeName = $typeName;
    }

    public static function createFromEntity(RoomType $roomTypeEntity): self
    {
        return new RoomTypeDto(
            $roomTypeEntity->getId(),
            $roomTypeEntity->getTypeName(),
        );
    }

    public static function createFromEntities(array $roomTypeEntity): array
    {
        $types = [];
        for($i = 0; $i < count($roomTypeEntity); $i++){
            $types[$i] = new RoomTypeDto(
                $roomTypeEntity[$i]->getId(),
                $roomTypeEntity[$i]->getTypeName(),
            );
        }
        return $types;
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getTypeName(): ?string
    {
        return $this->TypeName;
    }

    public function setTypeName(?string $TypeName): void
    {
        $this->TypeName = $TypeName;
    }
}