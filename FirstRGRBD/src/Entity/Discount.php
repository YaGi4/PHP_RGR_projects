<?php

namespace App\Entity;

use App\Repository\DiscountRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DiscountRepository::class)]
#[ORM\Table( name: 'discounts')]
class Discount
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'discount_code')]
    private ?int $id = null;

    #[ORM\Column(name: 'amount_of_discount')]
    private ?float $AmountOfDiscount = null;

    #[ORM\Column(name: 'discount_type', length: 255)]
    private ?string $DiscountTypeCharacter = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAmountOfDiscount(): ?float
    {
        return $this->AmountOfDiscount;
    }

    public function setAmountOfDiscount(float $AmountOfDiscount): static
    {
        $this->AmountOfDiscount = $AmountOfDiscount;

        return $this;
    }

    public function getDiscountTypeCharacter(): ?string
    {
        return $this->DiscountTypeCharacter;
    }

    public function setDiscountTypeCharacter(string $DiscountTypeCharacter): static
    {
        $this->DiscountTypeCharacter = $DiscountTypeCharacter;

        return $this;
    }
}
