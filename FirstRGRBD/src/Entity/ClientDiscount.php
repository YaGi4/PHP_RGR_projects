<?php

namespace App\Entity;

use App\Repository\ClientDiscountRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClientDiscountRepository::class)]
#[ORM\Table( name: 'clients_discount')]
class ClientDiscount
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'clients_discount_code')]
    private ?int $id = null;

    #[ORM\Column(name: 'client_code')]
    private ?int $ClientCode = null;

    #[ORM\Column(name: 'discount_code')]
    private ?int $DiscountCode = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getClientCode(): ?int
    {
        return $this->ClientCode;
    }

    public function setClientCode(int $ClientCode): static
    {
        $this->ClientCode = $ClientCode;

        return $this;
    }

    public function getDiscountCode(): ?int
    {
        return $this->DiscountCode;
    }

    public function setDiscountCode(int $DiscountCode): static
    {
        $this->DiscountCode = $DiscountCode;

        return $this;
    }
}
