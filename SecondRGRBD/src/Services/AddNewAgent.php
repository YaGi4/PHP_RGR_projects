<?php

namespace App\Services;

use App\Entity\AgentEntity;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;

class AddNewAgent
{
    public static function add(EntityManagerInterface $entityManager,Request $request): void
    {
        $Agent = new AgentEntity();
        $Agent->setAgentName($request->request->get("agent_name"));
        $Agent->setAgentSurname($request->request->get("agent_surname"));
        $Agent->setAgentPatronymic($request->request->get("agent_patronymic"));
        $Agent->setAgentAddress($request->request->get("agent_address"));
        $Agent->setAgentPhone($request->request->get("agent_phone"));
        $Agent->setCodeFilial((int)$request->request->get("filial"));
        $entityManager->persist($Agent);
        $entityManager->flush();
    }
}