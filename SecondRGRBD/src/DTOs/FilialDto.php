<?php

namespace App\DTOs;

use App\Entity\Filial;

class FilialDto
{

    public ?int $id = 0;
    public ?string $name = "";
    public ?string $address = "";
    public ?string $phone = "";

    public function __construct(int $id, string $name, string $address, string $phone)
    {
        $this->id = $id;
        $this->name = $name;
        $this->address = $address;
        $this->phone = $phone;
    }
    public static function createFromEntity(Filial $filialEntity): self
    {
        return new FilialDto($filialEntity->getId(), $filialEntity->getNameFilial(),
        $filialEntity->getAddress(), $filialEntity->getPhone());
    }
    public static function createFromEntities(array $filialEntity): array
    {
        $filials = [];
        for($i = 0; $i < count($filialEntity); $i++){
            $filials[$i] = new FilialDto(
                $filialEntity[$i]->getId(),
                $filialEntity[$i]->getNameFilial(),
                $filialEntity[$i]->getAddress(),
                $filialEntity[$i]->getPhone()
            );
        }
        return $filials;
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

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): void
    {
        $this->address = $address;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): void
    {
        $this->phone = $phone;
    }
}
