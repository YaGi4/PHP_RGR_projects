<?php

namespace App\Services;

use App\Entity\ClientDiscount;
use App\Entity\Discount;
use Doctrine\ORM\EntityManagerInterface;

class FindClientsDiscount
{
    public static function findDiscount(EntityManagerInterface $entityManager, int $clientCode): float
    {
        $discountSum = 0.0;
        $discounts = $entityManager->getRepository(ClientDiscount::class)->findAllDiscountByClientId($clientCode);
        foreach ($discounts as $disc){
            $discount = $entityManager->getRepository(Discount::class)->find($disc->getDiscountCode());
            $discountSum += $discount->getAmountOfDiscount();
        }
        return $discountSum;
    }
}