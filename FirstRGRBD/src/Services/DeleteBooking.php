<?php

namespace App\Services;

use App\Entity\Booking;
use App\Entity\CheckIn;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class DeleteBooking
{
    public static function delete(EntityManagerInterface $entityManager, Request $request): void
    {

        $entityManager->getRepository(CheckIn::class)->deleteByBookingId($request->request->get('id'));
        $entityManager->getRepository(Booking::class)->delete($request->request->get('id'));
    }
}