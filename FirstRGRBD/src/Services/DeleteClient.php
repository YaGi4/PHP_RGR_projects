<?php

namespace App\Services;

use App\Entity\Booking;
use App\Entity\CheckIn;
use App\Entity\Client;
use App\Entity\ClientDiscount;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
class DeleteClient
{
    public static function delete(EntityManagerInterface $entityManager, Request $request): void
    {
        $entityManager->getRepository(CheckIn::class)->deleteAllCheckInByClientId($request->request->get("id"));
        $entityManager->getRepository(Booking::class)->deleteAllBookingByClientId($request->request->get("id"));
        $entityManager->getRepository(ClientDiscount::class)->deleteAllDiscountByClientId($request->request->get("id"));
        $entityManager->getRepository(Client::class)->deleteClient($request->request->get("id"));
    }
}