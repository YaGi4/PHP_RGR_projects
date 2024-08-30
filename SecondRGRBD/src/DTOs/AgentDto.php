<?php

namespace App\DTOs;

use App\Entity\AgentEntity;
use App\Entity\Filial;
use Doctrine\ORM\EntityManagerInterface;

class AgentDto
{


    public ?int $id = null;
    public ?string $agentName = null;
    public ?string $agentSurname = null;
    public ?string $agentPatronymic = null;
    public ?string $address = null;
    public ?string $phone = null;
    public ?int $codeFilial = null;
    public ?string $filialName = null;


    public function __construct(int $id, string $agentName, string $agentSurname, string $agentPatronymic,
                                string $address, string $phone, ?int $codeFilial, string $filialName)
    {
        $this->id = $id;
        $this->agentName = $agentName;
        $this->agentSurname = $agentSurname;
        $this->agentPatronymic = $agentPatronymic;
        $this->address = $address;
        $this->phone = $phone;
        $this->codeFilial = $codeFilial;
        $this->filialName = $filialName;
    }

    public static function createFromEntity(EntityManagerInterface $entityManager, AgentEntity $agentEntity): self
    {
        return new AgentDto(
            $agentEntity->getId(),
            $agentEntity->getAgentName(),
            $agentEntity->getAgentSurname(),
            $agentEntity->getAgentPatronymic(),
            $agentEntity->getAgentAddress(),
            $agentEntity->getAgentPhone(),
            $agentEntity->getCodeFilial(),
            $entityManager->getRepository(Filial::class)->find($agentEntity->getCodeFilial())->getNameFilial()
        );
    }
    public static function  createFromEntities(EntityManagerInterface $entityManager, array $agentEntity): array
    {
        $agents = [];
        for($i = 0; $i < count($agentEntity); $i++){
            $agents[$i] = new AgentDto(
                $agentEntity[$i]->getId(),
                $agentEntity[$i]->getAgentName(),
                $agentEntity[$i]->getAgentSurname(),
                $agentEntity[$i]->getAgentPatronymic(),
                $agentEntity[$i]->getAgentAddress(),
                $agentEntity[$i]->getAgentPhone(),
                $agentEntity[$i]->getCodeFilial(),
                $entityManager->getRepository(Filial::class)->find($agentEntity[$i]->getCodeFilial())->getNameFilial()
            );
        }
        return $agents;
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getAgentName(): ?string
    {
        return $this->agentName;
    }

    public function setAgentName(?string $agentName): void
    {
        $this->agentName = $agentName;
    }

    public function getAgentSurname(): ?string
    {
        return $this->agentSurname;
    }

    public function setAgentSurname(?string $agentSurname): void
    {
        $this->agentSurname = $agentSurname;
    }

    public function getAgentPatronymic(): ?string
    {
        return $this->agentPatronymic;
    }

    public function setAgentPatronymic(?string $agentPatronymic): void
    {
        $this->agentPatronymic = $agentPatronymic;
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

    public function getCodeFilial(): ?int
    {
        return $this->codeFilial;
    }
    public function setCodeFilial(?int $codeFilial): void
    {
        $this->codeFilial = $codeFilial;
    }

}