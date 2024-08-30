<?php

namespace App\Controller;

use App\Entity\TypeWorks;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;

class CreateNewTypeWorkController extends AbstractController
{
    #[Route('/create/new/type/work', name: 'app_create_new_type_work', methods: ["GET"])]
    public function show(EntityManagerInterface $entityManager): Response
    {
        $session = new Session();
        $user_name = $session->get('name');
        return $this->render('create_new_type_work/index.html.twig', [
            'page_title' => 'New Type',
            'user_name' => $user_name
        ]);
    }
    #[Route('/create/new/type/work', name: 'app_create_new_type_work', methods: ["POST"])]
    public function create(EntityManagerInterface $entityManager, Request $request): Response
    {
        $session = new Session();
        if($session->get('role') == 1){
            $type = new TypeWorks();
            $type->setDescription($request->get('description'));
            $type->setPaymentForDay($request->get('payment'));

            $entityManager->persist($type);
            $entityManager->flush();
        }
        return $this->redirect("/get/all/types/works");
    }
}
