<?php

namespace App\Controller;

use App\DTOs\BookingDto;
use App\DTOs\ClientDto;
use App\DTOs\RoomDto;
use App\Entity\Client;
use App\Entity\Room;
use App\Services\AddNewBooking;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;

class CreateNewBookingController extends AbstractController
{
    #[Route('/create/new/booking', name: 'app_create_new_booking', methods: ["GET"])]
    public function show(EntityManagerInterface $entityManager): Response
    {
        $session = new Session();
        $userName = $session->get("name");
        $rooms = RoomDto::createFromEntities($entityManager, $entityManager->getRepository(Room::class)->findAll());
        $clients = ClientDto::createFromEntities($entityManager, $entityManager->getRepository(Client::class)->findAll());
        return $this->render('create_new_booking/index.html.twig', [
            'page_title' => "New Booking",
            'rooms' => $rooms,
            'clients' => $clients,
            'userName' => $userName
        ]);
    }
    #[Route('/create/new/booking', name: 'app_create_new_booking', methods: ["POST"])]
    public function add(EntityManagerInterface $entityManager, Request $request): Response
    {
        $session = new Session();
        if($session->get('role') == "admin"){
            AddNewBooking::create($entityManager, $request);
        }
        return $this->redirect('/get/all/booking');
    }
}
