<?php

namespace App\Entity;

use App\Repository\AgreementRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AgreementRepository::class)]
class Agreement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'code_agreement')]
    private ?int $id = null;

    #[ORM\Column(name: 'date_of_conclusion', type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateOfConclusion = null;

    #[ORM\Column(name: 'sum_insured')]
    private ?string $sumInsured = null;

    #[ORM\Column(name: 'tariff_rate')]
    private ?float $tariffRate = null;

    #[ORM\Column(name: 'code_agent')]
    private ?int $codeAgent = null;

    #[ORM\Column(name: 'code_insurance_type')]
    private ?int $codeInsuranceType = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateOfConclusion(): ?\DateTimeInterface
    {
        return $this->dateOfConclusion;
    }

    public function setDateOfConclusion(\DateTimeInterface $dateOfConclusion): static
    {
        $this->dateOfConclusion = $dateOfConclusion;

        return $this;
    }

    public function getSumInsured(): ?string
    {
        return $this->sumInsured;
    }

    public function setSumInsured(string $sumInsured): static
    {
        $this->sumInsured = $sumInsured;

        return $this;
    }

    public function getTariffRate(): ?float
    {
        return $this->tariffRate;
    }

    public function setTariffRate(float $tariffRate): static
    {
        $this->tariffRate = $tariffRate;

        return $this;
    }

    public function getCodeAgent(): ?int
    {
        return $this->codeAgent;
    }

    public function setCodeAgent(?int $codeAgent): static
    {
        $this->codeAgent = $codeAgent;

        return $this;
    }

    public function getCodeInsuranceType(): ?int
    {
        return $this->codeInsuranceType;
    }

    public function setCodeInsuranceType(?int $codeInsuranceType): static
    {
        $this->codeInsuranceType = $codeInsuranceType;

        return $this;
    }
}
