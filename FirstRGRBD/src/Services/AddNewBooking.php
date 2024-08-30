<?php

namespace App\Services;

use App\Entity\Booking;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class AddNewBooking
{
    public static function create(EntityManagerInterface $entityManager, Request $request): void
    {
        $booking = new Booking();
        $booking->setRoomCode($request->request->get('room'));
        $booking->setClientCode($request->request->get('client'));
        $booking->setBookingDate(new \DateTime(date('Y-m-d H:i:s', time())));
        $booking->setStartDate(new \DateTime(date('Y-m-d H:i:s', strtotime($request->request->get('start_date')))));
        $booking->setExpirationDate(new \DateTime(date('Y-m-d H:i:s', strtotime($request->request->get('expiration_date')))));
        $entityManager->persist($booking);
        $entityManager->flush();
    }
}