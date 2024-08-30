<?php

namespace App\Services;

use App\Entity\Agreement;
use App\Entity\InsuranceType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class DeleteInsuranceType
{
    public static function delete(EntityManagerInterface $entityManager, Request $request): void
    {
        $itemToBeRemoved = (int)$request->request->get("id");
        $agreements = $entityManager->getRepository(Agreement::class)->findByTypeId($itemToBeRemoved);
        foreach ($agreements as &$agreement)
        {
            DeleteAgreement::deleteById($entityManager, $agreement->GetId());
        }
        $entityManager->getRepository(InsuranceType::class)->delete($itemToBeRemoved);
    }
}