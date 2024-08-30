<?php

namespace App\Controller;

use App\DTOs\BookingDto;
use App\DTOs\ClientDto;
use App\Entity\Booking;
use App\Entity\Client;
use App\Services\AddNewCheckIn;
use App\Services\FindFreeRooms;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;

class CreateNewCheckInController extends AbstractController
{
    #[Route('/create/new/check/in', name: 'app_create_new_check_in', methods: ["GET"])]
    public function show(EntityManagerInterface $entityManager): Response
    {
        $session = new Session();
        $userName = $session->get("name");
        $clients = ClientDto::createFromEntities($entityManager, $entityManager->getRepository(Client::class)->findAll());
        $bookings = BookingDto::createFromEntities($entityManager, $entityManager->getRepository(Booking::class)->findAll());
        return $this->render('create_new_check_in/index.html.twig', [
            'page_title' => "New Check in",
            'clients' => $clients,
            'bookings' => $bookings,
            'userName' => $userName
        ]);
    }
    #[Route('/create/new/check/in', name: 'app_create_new_check_in', methods: ["POST"])]
    public function add(EntityManagerInterface $entityManager, Request $request): Response
    {
        $session = new Session();
        if($session->get('role') == "admin"){
            AddNewCheckIn::create($entityManager, $request);
        }
        return $this->redirect("/get/all/check/in");
    }
}
