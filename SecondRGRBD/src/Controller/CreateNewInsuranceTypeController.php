<?php

namespace App\Controller;

use App\Services\AddNewFililal;
use App\Services\AddNewInsuranceType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;

class CreateNewInsuranceTypeController extends AbstractController
{
    #[Route('/create/new/insurance/type', name: 'app_create_new_insurance_type', methods: ["GET"])]
    public function show(): Response
    {
        $session = new Session();
        $userName = $session->get("name");
        return $this->render('create_new_insurance_type/index.html.twig', [
            'page_title' => 'New Insurance type',
            'userName' =>$userName
        ]);
    }
    #[Route('/create/new/insurance/type', name: 'app_create_new_insurance_type',methods: ["POST"])]
    public function add(EntityManagerInterface $entityManager, Request $request): Response
    {
        $session = new Session();
        if($session->get('role') == "admin"){
            AddNewInsuranceType::add($entityManager, $request);
        }
        return $this->redirect("/get/all/insurance/type");
    }
}
