<?php

namespace App\DTOs;

use App\Entity\Client;
use App\Services\FindClientsDiscount;
use Doctrine\ORM\EntityManagerInterface;

class ClientDto
{

    public ?int $id = null;
    public ?string $Name = null;
    public ?string $Surname = null;
    public ?string $Patronymic = null;
    public ?string $Commentary = null;
    public ?string $PassportData = null;
    public ?float $Discounts = null;

    public function __construct(int $id, string $Name, string $Surname, string $Patronymic, string $Commentary, string $PassportData, float $Discounts)
    {
        $this->id = $id;
        $this->Name = $Name;
        $this->Surname = $Surname;
        $this->Patronymic = $Patronymic;
        $this->Commentary = $Commentary;
        $this->PassportData = $PassportData;
        $this->Discounts = $Discounts;
    }

    public static function createFromEntity(EntityManagerInterface $entityManager, Client $clientEntity): self
    {
        return new ClientDto(
            $clientEntity->getId(),
            $clientEntity->getName(),
            $clientEntity->getSurname(),
            $clientEntity->getPatronymic(),
            $clientEntity->getCommentary(),
            $clientEntity->getPassportData(),
            FindClientsDiscount::findDiscount($entityManager, $clientEntity->getId())
        );
    }

    public static function createFromEntities(EntityManagerInterface $entityManager, array $clientEntity): array
    {
        $clients = [];
        for($i = 0; $i < count($clientEntity); $i++){
            $clients[$i] = new ClientDto(
                $clientEntity[$i]->getId(),
                $clientEntity[$i]->getName(),
                $clientEntity[$i]->getSurname(),
                $clientEntity[$i]->getPatronymic(),
                $clientEntity[$i]->getCommentary(),
                $clientEntity[$i]->getPassportData(),
                FindClientsDiscount::findDiscount($entityManager, $clientEntity[$i]->getId())
            );
        }
        return $clients;
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
        return $this->Name;
    }

    public function setName(?string $Name): void
    {
        $this->Name = $Name;
    }

    public function getSurname(): ?string
    {
        return $this->Surname;
    }

    public function setSurname(?string $Surname): void
    {
        $this->Surname = $Surname;
    }

    public function getPatronymic(): ?string
    {
        return $this->Patronymic;
    }

    public function setPatronymic(?string $Patronymic): void
    {
        $this->Patronymic = $Patronymic;
    }

    public function getCommentary(): ?string
    {
        return $this->Commentary;
    }

    public function setCommentary(?string $Commentary): void
    {
        $this->Commentary = $Commentary;
    }

    public function getPassportData(): ?string
    {
        return $this->PassportData;
    }

    public function setPassportData(?string $PassportData): void
    {
        $this->PassportData = $PassportData;
    }

    public function getDiscounts(): ?float
    {
        return $this->Discounts;
    }

    public function setDiscounts(?float $Discounts): void
    {
        $this->Discounts = $Discounts;
    }
}