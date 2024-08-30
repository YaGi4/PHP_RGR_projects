<?php

namespace App\Controller;

use App\DTOs\RoomTypeDto;
use App\Entity\RoomType;
use App\Services\AddNewRoom;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;

class CreateNewRoomController extends AbstractController
{
    #[Route('/create/new/room', name: 'app_create_new_room', methods: ["GET"])]
    public function show(EntityManagerInterface $entityManager): Response
    {
        $session = new Session();
        $userName = $session->get("name");
        $roomType = RoomTypeDto::createFromEntities($entityManager->getRepository(RoomType::class)->findAll());
        return $this->render('create_new_room/index.html.twig', [
            'page_title' => "New Room",
            'types' => $roomType,
            'userName' => $userName
        ]);
    }
    #[Route('/create/new/room', name: 'app_create_new_room', methods: ["POST"])]
    public function add(EntityManagerInterface $entityManager, Request $request): Response
    {
        $session = new Session();
        if($session->get('role') == "admin"){
            AddNewRoom::add($entityManager, $request);
        }
        return $this->redirect("/get/all/rooms");
    }
}