<?php

namespace App\Entity;

use App\Repository\FilialRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FilialRepository::class)]
class Filial
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'code_filial')]
    private ?int $id = null;

    #[ORM\Column(name: 'name_filial', length: 30)]
    private ?string $nameFilial = null;

    #[ORM\Column(name: 'address', length: 50)]
    private ?string $address = null;

    #[ORM\Column(name: 'phone', length: 20)]
    private ?string $phone = null;

    #[ORM\OneToMany(mappedBy: 'codeFilial', targetEntity: AgentEntity::class, fetch: "LAZY")]
    #[ORM\JoinColumn(name: "code_agreement", referencedColumnName: "code_agreement")]
    private Collection $agentEntities;

    public function __construct()
    {
        $this->agentEntities = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameFilial(): ?string
    {
        return $this->nameFilial;
    }

    public function setNameFilial(string $nameFilial): static
    {
        $this->nameFilial = $nameFilial;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): static
    {
        $this->address = $address;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): static
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * @return Collection<int, AgentEntity>
     */
    public function getAgentEntities(): Collection
    {
        return $this->agentEntities;
    }

    public function addAgentEntity(AgentEntity $agentEntity): static
    {
        if (!$this->agentEntities->contains($agentEntity)) {
            $this->agentEntities->add($agentEntity);
            $agentEntity->setCodeFilial($this);
        }

        return $this;
    }

    public function removeAgentEntity(AgentEntity $agentEntity): static
    {
        if ($this->agentEntities->removeElement($agentEntity)) {
            // set the owning side to null (unless already changed)
            if ($agentEntity->getCodeFilial() === $this) {
                $agentEntity->setCodeFilial(null);
            }
        }

        return $this;
    }
}
