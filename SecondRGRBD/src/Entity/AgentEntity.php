<?php

namespace App\Entity;

use App\Repository\AgentEntityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Filial;

#[ORM\Entity(repositoryClass: AgentEntityRepository::class)]
#[ORM\Table( name: 'agents')]
class AgentEntity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'code_agent')]
    private ?int $id = null;

    #[ORM\Column(name: 'agent_name')]
    private ?string $agentName = null;

    #[ORM\Column(name: 'agent_surname')]
    private ?string $agentSurname = null;

    #[ORM\Column(name: 'agent_patronymic')]
    private ?string $agentPatronymic = null;

    #[ORM\Column(name: 'address')]
    private ?string $address = null;

    #[ORM\Column(name: 'phone')]
    private ?string $phone = null;

    #[ORM\Column(name: 'code_filial')]
//    #[ORM\JoinColumn(name: "code_filial", referencedColumnName: "code_filial")]
        private ?int $codeFilial = null;

    public function __construct()
    {
        $this->filial = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }
    
    public function getAgentName(): ?string
    {
        return $this->agentName;
    }

    public function setAgentName(string $agentName): static
    {
        $this->agentName = $agentName;

        return $this;
    }

    public function getAgentSurname (): ?string
    {
        return $this->agentSurname;
    }

    public function setAgentSurname (string $agentSurname): static
    {
        $this->agentSurname = $agentSurname;

        return $this;
    }
    public function getAgentPatronymic (): ?string
    {
        return $this->agentPatronymic;
    }

    public function setAgentPatronymic (string $agentPatronymic): static
    {
        $this->agentPatronymic = $agentPatronymic;

        return $this;
    }
    public function getAgentAddress (): ?string
    {
        return $this->address;
    }

    public function setAgentAddress (string $address): static
    {
        $this->address = $address;

        return $this;
    }

    public function getAgentPhone (): ?string
    {
        return $this->phone;
    }

    public function setAgentPhone(string $phone): static
    {
        $this->phone = $phone;

        return $this;
    }

    public function getCodeFilial(): int
    {
        return $this->codeFilial;
    }

    public function setCodeFilial(int $codeFilial): static
    {
        $this->codeFilial = $codeFilial;

        return $this;
    }

}
