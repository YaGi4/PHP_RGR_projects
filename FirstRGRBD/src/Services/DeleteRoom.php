<?php

namespace App\Services;

use App\Entity\Booking;
use App\Entity\CheckIn;
use App\Entity\Room;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class DeleteRoom
{
    public static function delete(EntityManagerInterface $entityManager, Request $request): void
    {
        $entityManager->getRepository(CheckIn::class)->deleteCheckInByRoomId($request->request->get("id"));
        $entityManager->getRepository(Booking::class)->deleteBookingByRoomId($request->request->get("id"));
        $entityManager->getRepository(Room::class)->deleteRoom($request->request->get("id"));
    }
}