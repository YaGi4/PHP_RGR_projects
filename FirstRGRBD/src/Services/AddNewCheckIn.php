<?php

namespace App\Services;

use App\DTOs\ClientDto;
use App\Entity\Booking;
use App\Entity\CheckIn;
use App\Entity\Client;
use App\Entity\Room;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class AddNewCheckIn
{
    public static function create(EntityManagerInterface $entityManager, Request $request): void
    {
        $client = ClientDto::createFromEntity($entityManager, $entityManager->getRepository(Client::class)
            ->find($entityManager->getRepository(Booking::class)->find($request->request->get('booking'))->getClientCode()));
        $checkIn = new CheckIn();
        $checkIn->setSettlementDate(new \DateTime(date('Y-m-d H:i:s', strtotime($request->request->get('settlement_date')))));
        $checkIn->setRoomCode($entityManager->getRepository(Booking::class)->find($request->request->get('booking'))->getRoomCode());
        $checkIn->setClientCode($entityManager->getRepository(Booking::class)->find($request->request->get('booking'))->getClientCode());
        $checkIn->setBookingCode($request->request->get('booking'));
        $checkIn->setNote($request->request->get('note'));
        $checkIn->setDateOfRelease(new \DateTime(date('Y-m-d H:i:s', strtotime($request->request->get('date_of_release')))));
        if($client->getDiscounts() != 0){
            $checkIn->setPaymentAmount($entityManager->getRepository(Room::class)->find($checkIn->getRoomCode())->getPrice() * (1 - ($client->getDiscounts() / 100)));
        }
        else{
            $checkIn->setPaymentAmount($entityManager->getRepository(Room::class)->find($checkIn->getRoomCode())->getPrice());
        }
        $entityManager->persist($checkIn);
        $entityManager->flush();
    }
}