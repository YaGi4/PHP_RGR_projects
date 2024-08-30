<?php

namespace App\Services;

use App\Entity\Agreement;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\DBAL\Types\Types;

class AddNewAgreement
{
    public static function add(EntityManagerInterface $entityManager, Request $request): void
    {
        $Agreement = new Agreement();
        $Agreement->setDateOfConclusion(new \DateTime(date('Y-m-d H:i:s', time())));
        $Agreement->setSumInsured($request->request->get("sum_of_insured"));
        $Agreement->setTariffRate($request->request->get("tariff_rate"));
        $Agreement->setCodeAgent($request->request->get("agent"));
        $Agreement->setCodeInsuranceType($request->request->get("type"));
        $entityManager->persist($Agreement);
        $entityManager->flush();
    }
}