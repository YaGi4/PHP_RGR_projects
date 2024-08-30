<?php

namespace App\Services;

use App\Entity\AgentEntity;
use App\Entity\Filial;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class DeleteFililal
{
    public static function delete(EntityManagerInterface $entityManager, Request $request): void
    {
        $itemToBeRemoved = (int)$request->request->get("id");
        $agents = $entityManager->getRepository(AgentEntity::class)->findByFilialId($itemToBeRemoved);
        DeleteAgent::deleteMass($entityManager, $agents);
        $entityManager->getRepository(Filial::class)->delete($itemToBeRemoved);
    }
}