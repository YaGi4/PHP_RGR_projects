<?php

namespace App\Controller;

use App\DTOs\RoomDto;
use App\Entity\Room;
use App\Services\DeleteRoom;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;

class GetAllRoomsController extends AbstractController
{
    #[Route('/get/all/rooms', name: 'app_get_all_rooms', methods: ["GET"])]
    public function show(EntityManagerInterface $entityManager): Response
    {
        $session = new Session();
        $userName = $session->get("name");
        $rooms = RoomDto::createFromEntities($entityManager, $entityManager->getRepository(Room::class)->findAll());
        return $this->render('get_all_rooms/index.html.twig', [
            'rooms' => $rooms,
            'page_title' => "Rooms",
            'userName' => $userName
        ]);
    }
    #[Route('/get/all/rooms', name: 'app_get_all_rooms', methods: ["POST"])]
    public function delete(EntityManagerInterface $entityManager, Request $request): Response
    {
        $session = new Session();
        if($session->get('role') == "admin"){
            DeleteRoom::delete($entityManager, $request);
        }
        return $this->redirect("/get/all/rooms");
    }
}
