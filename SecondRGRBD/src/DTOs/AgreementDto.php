<?php

namespace App\DTOs;

use App\Entity\AgentEntity;
use App\Entity\Agreement;
use App\Entity\InsuranceType;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\EntityManagerInterface;

class AgreementDto
{

    public ?int $id = null;
    public ?\DateTimeInterface $dateOfConclusion = null;
    public ?string $sumInsured = null;

    public ?float $tariffRate = null;

    public ?int $codeAgent = null;

    public ?int $codeInsuranceType = null;
    public ?string $agentName = null;
    public ?string $insuranceType = null;

    public function __construct(int $id, \DateTimeInterface $dateOfConclusion, string $sumInsured, float $tariffRate,
                                int $codeAgent, int $codeInsuranceType, string $agentName, string $insuranceType)
    {
        $this->id = $id;
        $this->dateOfConclusion = $dateOfConclusion;
        $this->sumInsured = $sumInsured;
        $this->tariffRate = $tariffRate;
        $this->codeAgent = $codeAgent;
        $this->codeInsuranceType = $codeInsuranceType;
        $this->agentName = $agentName;
        $this->insuranceType = $insuranceType;
    }

    public static function createFromEntity(EntityManagerInterface $entityManager, Agreement $agreement): self
    {
        return new AgreementDto(
            $agreement->getId(),
            $agreement->getDateOfConclusion(),
            $agreement->getSumInsured(),
            $agreement->getTariffRate(),
            $agreement->getCodeAgent(),
            $agreement->getCodeInsuranceType(),
            $entityManager->getRepository(AgentEntity::class)->find($agreement->getCodeAgent())->getAgentName(),
            $entityManager->getRepository(InsuranceType::class)->find($agreement->getCodeInsuranceType())->getNameOfInsurance()
        );
    }
    public static function createFromEntities(EntityManagerInterface $entityManager, array $agreements): array
    {
        $agents = [];
        for($i = 0; $i < count($agreements); $i++){
            $agents[$i] = new AgreementDto(
                $agreements[$i]->getId(),
                $agreements[$i]->getDateOfConclusion(),
                $agreements[$i]->getSumInsured(),
                $agreements[$i]->getTariffRate(),
                $agreements[$i]->getCodeAgent(),
                $agreements[$i]->getCodeInsuranceType(),
                $entityManager->getRepository(AgentEntity::class)->find($agreements[$i]->getCodeAgent())->getAgentName(),
                $entityManager->getRepository(InsuranceType::class)->find($agreements[$i]->getCodeInsuranceType())->getNameOfInsurance()
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

    public function getDateOfConclusion(): ?\DateTimeInterface
    {
        return $this->dateOfConclusion;
    }

    public function getDateOfConclusionInString(): ?string
    {
        return $this->dateOfConclusion->format('Y-m-d H:i:s');
    }
    public function setDateOfConclusion(?\DateTimeInterface $dateOfConclusion): void
    {
        $this->dateOfConclusion = $dateOfConclusion;
    }

    public function getSumInsured(): ?string
    {
        return $this->sumInsured;
    }

    public function setSumInsured(?string $sumInsured): void
    {
        $this->sumInsured = $sumInsured;
    }

    public function getTariffRate(): ?float
    {
        return $this->tariffRate;
    }

    public function setTariffRate(?float $tariffRate): void
    {
        $this->tariffRate = $tariffRate;
    }

    public function getCodeAgent(): ?int
    {
        return $this->codeAgent;
    }

    public function setCodeAgent(?int $codeAgent): void
    {
        $this->codeAgent = $codeAgent;
    }

    public function getCodeInsuranceType(): ?int
    {
        return $this->codeInsuranceType;
    }

    public function setCodeInsuranceType(?int $codeInsuranceType): void
    {
        $this->codeInsuranceType = $codeInsuranceType;
    }

}