<?php

namespace App\Controller;

use App\DTOs\InsuranceTypeDto;
use App\Entity\InsuranceType;
use App\Services\DeleteInsuranceType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;

class GetAllInsuranceTypeController extends AbstractController
{
    #[Route('/get/all/insurance/type', name: 'app__get_all_insurance_type', methods: ["GET"])]
    public function show(EntityManagerInterface $entityManager): Response
    {
        $session = new Session();
        $userName = $session->get("name");
        $types = InsuranceTypeDto::createFromEntities($entityManager->getRepository(InsuranceType::class)->findAllInsuranceType());
        return $this->render('get_all_insurance_type/index.html.twig', [
            'page_title' => 'Insurance types',
            'types' => $types,
            'userName' => $userName
        ]);
    }
    #[Route('/get/all/insurance/type', name: 'app__get_all_insurance_type', methods: ["POST"])]
    public function delete(EntityManagerInterface $entityManager, Request $request): Response
    {
        $session = new Session();
        if($session->get('role') == "admin"){
            DeleteInsuranceType::delete($entityManager, $request);
        }
        return $this->redirect("/get/all/insurance/type");
    }
}
