<?php

namespace App\Controller;

use App\DTOs\ClientDto;
use App\Entity\Client;
use App\Services\DeleteClient;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;

class GetAllClientsController extends AbstractController
{
    #[Route('/get/all/clients', name: 'app_get_all_clients', methods: ["GET"])]
    public function show(EntityManagerInterface $entityManager): Response
    {
        $session = new Session();
        $userName = $session->get("name");
        $clients =  ClientDto::createFromEntities($entityManager, $entityManager->getRepository(Client::class)->findAllClient());
        return $this->render('get_all_clients/index.html.twig', [
            'page_title' => "Clients",
            'clients' => $clients,
            'userName' => $userName
        ]);
    }

    #[Route('/get/all/clients', name: 'app_get_all_clients', methods: ["POST"])]
    public function delete(EntityManagerInterface $entityManager, Request $request): Response
    {
        $session = new Session();
        if($session->get("role") == "admin"){
            DeleteClient::delete($entityManager, $request);
        }
        return $this->redirect("/get/all/clients");
    }
}
