<?php

namespace App\Controller;

use App\DTOs\AgreementDto;
use App\Entity\Agreement;
use App\Services\DeleteAgreement;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;

class GetAllAgreementController extends AbstractController
{
    #[Route('/get/all/agreements', name: 'app_get_all_agreement', methods: ["GET"])]
    public function show(EntityManagerInterface $entityManager): Response
    {
        $session = new Session();
        $userName = $session->get("name");
        $agreementEntity = $entityManager->getRepository(Agreement::class)->findAllAgreements();
        $agreements = AgreementDto::createFromEntities($entityManager, $agreementEntity);
        return $this->render('get_all_agreement/index.html.twig', [
            'agreements' => $agreements,
            'page_title' => "Agreements",
            'userName' =>$userName
        ]);
    }
    #[Route('/get/all/agreements', name: 'app_get_all_agreement', methods: ["POST"])]
    public function delete(EntityManagerInterface $entityManager, Request $request): Response
    {
        DeleteAgreement::delete($entityManager, $request);
        return $this->redirect("/get/all/agreements");
    }
}
