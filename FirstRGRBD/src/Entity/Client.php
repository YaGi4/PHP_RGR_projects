<?php

namespace App\Entity;

use App\Repository\ClientRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClientRepository::class)]
#[ORM\Table( name: 'client')]
class Client
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'client_code')]
    private ?int $id = null;

    #[ORM\Column(name: 'surname', length: 255)]
    private ?string $Surname = null;

    #[ORM\Column(name: 'name', length: 255)]
    private ?string $Name = null;

    #[ORM\Column(name: 'patronymic', length: 255)]
    private ?string $Patronymic = null;

    #[ORM\Column(name: 'commentary', length: 255)]
    private ?string $Commentary = null;

    #[ORM\Column(name: 'passport_data', length: 255)]
    private ?string $PassportData = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSurname(): ?string
    {
        return $this->Surname;
    }

    public function setSurname(string $Surname): static
    {
        $this->Surname = $Surname;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): static
    {
        $this->Name = $Name;

        return $this;
    }

    public function getPatronymic(): ?string
    {
        return $this->Patronymic;
    }

    public function setPatronymic(string $Patronymic): static
    {
        $this->Patronymic = $Patronymic;

        return $this;
    }

    public function getCommentary(): ?string
    {
        return $this->Commentary;
    }

    public function setCommentary(string $Commentary): static
    {
        $this->Commentary = $Commentary;

        return $this;
    }

    public function getPassportData(): ?string
    {
        return $this->PassportData;
    }

    public function setPassportData(string $PassportData): static
    {
        $this->PassportData = $PassportData;

        return $this;
    }
}
