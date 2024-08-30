<?php

namespace App\Controller;

use App\DTOs\AgentDto;
use App\DTOs\InsuranceTypeDto;
use App\Entity\AgentEntity;
use App\Entity\InsuranceType;
use App\Services\AddNewAgreement;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;

class CreateNewAgreementController extends AbstractController
{
    #[Route('/create/new/agreement', name: 'app_create_new_agreement', methods: ["GET"])]
    public function show(EntityManagerInterface $entityManager): Response
    {
        $session = new Session();
        $userName = $session->get("name");
        $agents = AgentDto::createFromEntities($entityManager, $entityManager->getRepository(AgentEntity::class)->findAllAgent());
        $types = InsuranceTypeDto::createFromEntities($entityManager->getRepository(InsuranceType::class)->findAllInsuranceType());
        return $this->render('create_new_agreement/index.html.twig', [
            'page_title' => "New agreements",
            'agents' => $agents,
            'types' => $types,
            'userName' => $userName
        ]);
    }
    #[Route('/create/new/agreement', name: 'app_create_new_agreement', methods:["POST"])]
    public function post(EntityManagerInterface $entityManager, Request $request): Response
    {
        AddNewAgreement::add($entityManager, $request);
        return $this->redirect("/get/all/agreements");
    }
}
