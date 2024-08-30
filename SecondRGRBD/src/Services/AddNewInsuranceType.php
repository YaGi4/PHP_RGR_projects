<?php

namespace App\Services;

use App\Entity\InsuranceType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class AddNewInsuranceType
{
    public static function add(EntityManagerInterface $entityManager, Request $request): void
    {
        $type = new InsuranceType();
        $type->setNameOfInsurance($request->request->get("name"));
        $entityManager->persist($type);
        $entityManager->flush();
    }
}