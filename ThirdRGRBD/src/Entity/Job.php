<?php

namespace App\Entity;

use App\Repository\JobRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: JobRepository::class)]
#[ORM\Table(name: 'jobs')]
class Job
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'id_jobs')]
    private ?int $id = null;

    #[ORM\Column(name: 'id_types_works')]
    private ?int $idTypeWork = null;

    #[ORM\Column(name: 'durationhrs')]
    private ?int $duration = null;

    #[ORM\Column(name: 'date_beginning', type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateBeginning = null;

    #[ORM\Column(name: 'date_end', type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateEnd = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdTypeWork(): ?int
    {
        return $this->idTypeWork;
    }

    public function setIdTypeWork(int $idTypeWork): static
    {
        $this->idTypeWork = $idTypeWork;

        return $this;
    }

    public function getDuration(): ?int
    {
        return $this->duration;
    }

    public function setDuration(int $duration): static
    {
        $this->duration = $duration;

        return $this;
    }

    public function getDateBeginning(): ?\DateTimeInterface
    {
        return $this->dateBeginning;
    }

    public function setDateBeginning(\DateTimeInterface $dateBeginning): static
    {
        $this->dateBeginning = $dateBeginning;

        return $this;
    }

    public function getDateEnd(): ?\DateTimeInterface
    {
        return $this->dateEnd;
    }

    public function setDateEnd(\DateTimeInterface $dateEnd): static
    {
        $this->dateEnd = $dateEnd;

        return $this;
    }
}
