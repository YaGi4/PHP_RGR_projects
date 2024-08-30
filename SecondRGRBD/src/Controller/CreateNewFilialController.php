<?php

namespace App\Controller;

use App\Services\AddNewFililal;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;

class CreateNewFilialController extends AbstractController
{

    #[Route('/create/new/filial', name: 'app_create_new_filial', methods: ["GET"])]
    public function show(EntityManagerInterface $entityManager): Response
    {
        $session = new Session();
        $userName = $session->get("name");
        return $this->render('create_new_filial/index.html.twig', [
            'page_title' => 'New Filial',
            'userName' => $userName
        ]);
    }

    #[Route('/create/new/filial', name: 'app_create_new_filial', methods:["POST"])]
    public function post(EntityManagerInterface $entityManager, Request $request): Response
    {
        $session = new Session();
        if($session->get('role') == "admin"){
            AddNewFililal::add($entityManager, $request);
        }
        return $this->redirect("/get/all/filials");
    }
}
