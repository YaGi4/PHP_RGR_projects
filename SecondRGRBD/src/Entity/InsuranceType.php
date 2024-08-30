<?php

namespace App\Entity;

use App\Repository\InsuranceTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InsuranceTypeRepository::class)]
class InsuranceType
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'code_insurance_type')]
    private ?int $id = null;

    #[ORM\Column(name: 'name_of_insurance', length: 20)]
    private ?string $nameOfInsurance = null;

    #[ORM\OneToMany(mappedBy: 'codeInsuranceType', targetEntity: Agreement::class)]
    #[ORM\JoinColumn(name: "code_insurance_type", referencedColumnName: "code_insurance_type")]
    private Collection $agreements;

    public function __construct()
    {
        $this->agreements = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameOfInsurance(): ?string
    {
        return $this->nameOfInsurance;
    }

    public function setNameOfInsurance(string $nameOfInsurance): static
    {
        $this->nameOfInsurance = $nameOfInsurance;

        return $this;
    }

    /**
     * @return Collection<int, Agreement>
     */
    public function getAgreements(): Collection
    {
        return $this->agreements;
    }

    public function addAgreement(Agreement $agreement): static
    {
        if (!$this->agreements->contains($agreement)) {
            $this->agreements->add($agreement);
            $agreement->setCodeIncuranseType($this);
        }

        return $this;
    }

    public function removeAgreement(Agreement $agreement): static
    {
        if ($this->agreements->removeElement($agreement)) {
            // set the owning side to null (unless already changed)
            if ($agreement->getCodeIncuranseType() === $this) {
                $agreement->setCodeIncuranseType(null);
            }
        }

        return $this;
    }
}
