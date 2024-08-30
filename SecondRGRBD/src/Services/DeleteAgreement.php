<?php

namespace App\Services;

use App\Entity\Agreement;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class DeleteAgreement
{
    public static function delete(EntityManagerInterface $entityManager,Request $request): void
    {
        $itemToBeRemoved = (int)$request->request->get("id");
        $entityManager->getRepository(Agreement::class)->delete($itemToBeRemoved);
    }
    public static function deleteById(EntityManagerInterface $entityManager,int $id): void
    {
        $entityManager->getRepository(Agreement::class)->delete($id);
    }
}