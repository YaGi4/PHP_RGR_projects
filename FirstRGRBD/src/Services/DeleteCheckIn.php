<?php

namespace App\Services;

use App\Entity\CheckIn;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class DeleteCheckIn
{
    public static function delete(EntityManagerInterface $entityManager, Request $request): void
    {
        $entityManager->getRepository(CheckIn::class)->delete($request->request->get('id'));
    }
}