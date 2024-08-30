<?php

namespace App\Entity;

use App\Repository\EmployeeWorksRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EmployeeWorksRepository::class)]
#[ORM\Table(name: 'employees_works')]
class EmployeeWorks
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'id_employees_works')]
    private ?int $id = null;

    #[ORM\Column(name: 'id_jobs')]
    private ?int $idJob = null;

    #[ORM\Column(name: 'id_employee')]
    private ?int $idEmployee = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdJob(): ?int
    {
        return $this->idJob;
    }

    public function setIdJob(int $idJob): static
    {
        $this->idJob = $idJob;

        return $this;
    }

    public function getIdEmployee(): ?int
    {
        return $this->idEmployee;
    }

    public function setIdEmployee(int $idEmployee): static
    {
        $this->idEmployee = $idEmployee;

        return $this;
    }
}
