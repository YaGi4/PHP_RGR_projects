<?php

namespace App\Controller;

use App\DTOs\AgentDto;
use App\Services\DeleteAgent;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\AgentEntity;
use Doctrine\ORM\EntityManagerInterface;

class GetAllAgentController extends AbstractController
{
    #[Route('/get/all/agent', name: 'app_get_all_agent', methods: ["GET"])]
    public function show(EntityManagerInterface $entityManager): Response
    {
        $session = new Session();
        $userName = $session->get("name");
        $agentsEntity = $entityManager->getRepository(AgentEntity::class)->findAllAgent();
        $agents = AgentDto::createFromEntities($entityManager, $agentsEntity);
        return $this->render('Agents.html.twig',[
            'page_title' => 'Agents',
            'agents' => $agents,
            'userName' =>$userName
        ]);
    }

    #[Route('/get/all/agent', name: 'app_get_all_agent', methods: ["POST"])]
    public function delete(EntityManagerInterface $entityManager, Request $request): Response
    {
        DeleteAgent::delete($entityManager, $request);
        return $this->redirect("/get/all/agent");
    }
}
