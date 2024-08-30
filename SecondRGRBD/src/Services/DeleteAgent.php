<?php

namespace App\Services;

use App\Entity\AgentEntity;
use App\Entity\Agreement;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;

class DeleteAgent
{
    public static function delete(EntityManagerInterface $entityManager,Request $request): void
    {
        $itemToBeRemoved = (int)$request->request->get("id");
        $entityManager->getRepository(Agreement::class)->deleteByAgentId($itemToBeRemoved);
        $entityManager->getRepository(AgentEntity::class)->delete($itemToBeRemoved);
    }
    public static function deleteMass(EntityManagerInterface $entityManager, array $request): void
    {
        foreach ($request as &$ragent){
            $itemToBeRemoved = $ragent->getId();
            $entityManager->getRepository(Agreement::class)->deleteByAgentId($itemToBeRemoved);
            $entityManager->getRepository(AgentEntity::class)->delete($itemToBeRemoved);
        }
    }
}