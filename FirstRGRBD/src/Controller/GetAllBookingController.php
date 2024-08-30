<?php

namespace App\Controller;

use App\DTOs\BookingDto;
use App\Entity\Booking;
use App\Services\DeleteBooking;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;

class GetAllBookingController extends AbstractController
{
    #[Route('/get/all/booking', name: 'app_get_all_booking', methods: ["GET"])]
    public function show(EntityManagerInterface $entityManager): Response
    {
        $session = new Session();
        $userName = $session->get("name");
        $bookings = BookingDto::createFromEntities($entityManager, $entityManager->getRepository(Booking::class)->findAll());
        return $this->render('get_all_booking/index.html.twig', [
            'page_title' => "Booking",
            'bookings' => $bookings,
            'userName' => $userName
        ]);
    }
    #[Route('/get/all/booking', name: 'app_get_all_booking', methods: ["POST"])]
    public function delete(EntityManagerInterface $entityManager, Request $request): Response
    {
        $session = new Session();
        if($session->get('role') == "admin"){
            DeleteBooking::delete($entityManager, $request);
        }
        return $this->redirect("/get/all/booking");
    }
}
