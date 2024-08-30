<?php

namespace App\Entity;

use App\Repository\TypeWorksRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TypeWorksRepository::class)]
#[ORM\Table(name: 'types_works')]
class TypeWorks
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'id_types_works')]
    private ?int $id = null;

    #[ORM\Column(name: 'types_works_description', length: 255)]
    private ?string $description = null;

    #[ORM\Column(name: 'payment_for_day')]
    private ?float $paymentForDay = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getPaymentForDay(): ?float
    {
        return $this->paymentForDay;
    }

    public function setPaymentForDay(float $paymentForDay): static
    {
        $this->paymentForDay = $paymentForDay;

        return $this;
    }
}
