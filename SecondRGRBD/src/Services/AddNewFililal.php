<?php

namespace App\Services;

use App\Entity\Filial;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class AddNewFililal
{
    public static function add(EntityManagerInterface $entityManager, Request $request): void
    {
        $Filial = new Filial();
        $Filial->setNameFilial($request->request->get("name"));
        $Filial->setAddress($request->request->get("address"));
        $Filial->setPhone($request->request->get("phone"));
        $entityManager->persist($Filial);
        $entityManager->flush();
    }
}