<?php

namespace App\Controller;

use App\DTOs\CheckInDto;
use App\Entity\CheckIn;
use App\Services\DeleteCheckIn;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;

class GetAllCheckInController extends AbstractController
{
    #[Route('/get/all/check/in', name: 'app_get_all_check_in', methods: ["GET"])]
    public function show(EntityManagerInterface $entityManager): Response
    {
        $session = new Session();
        $userName = $session->get("name");
        $checkIns = CheckInDto::createFromEntities($entityManager, $entityManager->getRepository(CheckIn::class)->findAll());
        return $this->render('get_all_check_in/index.html.twig', [
            'page_title' => "Check In",
            'checkIns' => $checkIns,
            'userName' => $userName
        ]);
    }
    #[Route('/get/all/check/in', name: 'app_get_all_check_in', methods: ["POST"])]
    public function delete(EntityManagerInterface $entityManager, Request $request): Response
    {
        $session = new Session();
        if($session->get('role') == "admin"){
            DeleteCheckIn::delete($entityManager, $request);
        }
        return $this->redirect("/get/all/check/in");
    }
}
