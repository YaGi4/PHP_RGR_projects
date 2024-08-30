<?php

namespace App\Services;

use App\Entity\Room;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class AddNewRoom
{
    public static function add(EntityManagerInterface $entityManager, Request $request): void
    {
        $room = new Room();
        $room->setRoomNumber($request->request->get('number'));
        $room->setPrice($request->request->get('price'));
        $room->setNumberOfPersons($request->request->get('number_of_person'));
        $room->setRoomTypeCode($request->request->get('type'));
        $entityManager->persist($room);
        $entityManager->flush();
    }
}