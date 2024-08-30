<?php

namespace App\Controller;

use App\DTOs\DiscountDto;
use App\Entity\Discount;
use App\Services\AddNewClient;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;

class CreateNewClientController extends AbstractController
{
    #[Route('/create/new/client', name: 'app_create_new_client', methods: ["GET"])]
    public function show(EntityManagerInterface $entityManager): Response
    {
        $session = new Session();
        $userName = $session->get("name");
        $discount = DiscountDto::createFromEntities($entityManager->getRepository(Discount::class)->findAllDiscount());
        return $this->render('create_new_client/index.html.twig', [
            'discounts' => $discount,
            'page_title' => "New Client",
            'userName' => $userName
        ]);
    }
    #[Route('/create/new/client', name: 'app_create_new_client', methods: ["POST"])]
    public function add(EntityManagerInterface $entityManager, Request $request): Response
    {
        $session = new Session();
        if($session->get("role") == "admin"){
            AddNewClient::add($entityManager, $request);
        }
        return $this->redirect("/get/all/clients");
    }
}
