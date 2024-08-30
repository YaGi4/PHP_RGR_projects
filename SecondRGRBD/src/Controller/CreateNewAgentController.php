<?php

namespace App\Controller;

use App\DTOs\AgentDto;
use App\DTOs\FilialDto;
use App\Entity\AgentEntity;
use App\Entity\Filial;
use App\Services\AddNewAgent;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;

class CreateNewAgentController extends AbstractController
{
    #[Route('/create/new/agent', name: 'app_create_new_agent', methods:["GET"])]
    public function show(EntityManagerInterface $entityManager): Response
    {
        $session = new Session();
        $userName = $session->get("name");
        $FilialsEntity = $entityManager->getRepository(Filial::class)->findAllFilials();
        $Filials = FilialDto::createFromEntities($FilialsEntity);
        return $this->render('NewAgent.html.twig', [
            'page_title' => "New Agent",
            'filials' => $Filials,
            'userName' =>$userName
        ]);
    }
    #[Route('/create/new/agent', name: 'app_create_new_agent', methods:["POST"])]
    public function post(EntityManagerInterface $entityManager, Request $request): Response
    {
        AddNewAgent::add($entityManager, $request);
        return $this->redirect("/get/all/agent");
    }
}
