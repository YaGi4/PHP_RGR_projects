<?php

namespace App\DTOs;

use App\Entity\InsuranceType;

class InsuranceTypeDto
{
    public ?int $id = null;
    public ?string $name = null;

    public function __construct(int $id, string $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    public static function createFromEntity(InsuranceType $typeEntity): self
    {
        return new InsuranceTypeDto(
            $typeEntity->getId(),
            $typeEntity->getNameOfInsurance()
        );
    }
    public static function createFromEntities(array $typeEntity): array
    {
        $types = [];
        for($i = 0; $i < count($typeEntity); $i++){
            $types[$i] = new InsuranceTypeDto(
                $typeEntity[$i]->getId(),
                $typeEntity[$i]->getNameOfInsurance()
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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }
}