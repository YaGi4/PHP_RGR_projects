<?php

namespace App\Services;

use App\Entity\Client;
use App\Entity\ClientDiscount;
use App\Entity\Discount;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class AddNewClient
{
    public static function add(EntityManagerInterface $entityManager, Request $request): void
    {
        $Client = new Client();
        $Client->setName($request->request->get('name'));
        $Client->setSurname($request->request->get('surname'));
        $Client->setPatronymic($request->request->get('patronymic'));
        $Client->setCommentary($request->request->get('commentary'));
        $Client->setPassportData($request->request->get('passport_data'));
        $entityManager->persist($Client);
        $entityManager->flush();
        $Client = $entityManager->getRepository(Client::class)->findIDByParams(
            $request->request->get('name'), $request->request->get('surname'),
            $request->request->get('patronymic'), $request->request->get('commentary'),
            $request->request->get('passport_data'));
        $discount = $entityManager->getRepository(Discount::class)->findAllDiscount();
        for ($i = 1; $i <= count($discount); $i++){
            if($request->request->get((string)$i) != null){
                $CD = new ClientDiscount();
                $CD->setClientCode($Client[0]->getId());
                $CD->setDiscountCode($i);
                $entityManager->persist($CD);
                $entityManager->flush();
            }
        }
    }
}