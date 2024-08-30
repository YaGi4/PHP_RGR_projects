<?php

namespace App\DTOs;

use App\Entity\Discount;

class DiscountDto
{
    public ?int $id = null;
    public ?float $AmountOfDiscount = null;
    public ?string $DiscountTypeCharacter = null;

    public function __construct(int $id, float $AmountOfDiscount, string $DiscountTypeCharacter)
    {
        $this->id = $id;
        $this->AmountOfDiscount = $AmountOfDiscount;
        $this->DiscountTypeCharacter = $DiscountTypeCharacter;
    }

    public static function createFromEntity(Discount $discountEntity): self
    {
        return new DiscountDto(
            $discountEntity->getId(),
            $discountEntity->getAmountOfDiscount(),
            $discountEntity->getDiscountTypeCharacter(),
        );
    }

    public static function createFromEntities(array $discountEntity): array
    {
        $discounts = [];
        for($i = 0; $i < count($discountEntity); $i++){
            $discounts[$i] = new DiscountDto(
                $discountEntity[$i]->getId(),
                $discountEntity[$i]->getAmountOfDiscount(),
                $discountEntity[$i]->getDiscountTypeCharacter(),
            );
        }
        return $discounts;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getAmountOfDiscount(): ?float
    {
        return $this->AmountOfDiscount;
    }

    public function setAmountOfDiscount(?float $AmountOfDiscount): void
    {
        $this->AmountOfDiscount = $AmountOfDiscount;
    }

    public function getDiscountTypeCharacter(): ?string
    {
        return $this->DiscountTypeCharacter;
    }

    public function setDiscountTypeCharacter(?string $DiscountTypeCharacter): void
    {
        $this->DiscountTypeCharacter = $DiscountTypeCharacter;
    }
}