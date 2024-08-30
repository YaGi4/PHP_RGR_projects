<?php

namespace App\Controller;

use App\Entity\Employee;
use App\Entity\EmployeeWorks;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;

class CreateNewEmployeerController extends AbstractController
{
    #[Route('/create/new/employeer', name: 'app_create_new_employeer', methods: ["GET"])]
    public function show(EntityManagerInterface $entityManager): Response
    {
        $session = new Session();
        $user_name = $session->get('name');
        return $this->render('create_new_employeer/index.html.twig', [
            'page_title' => 'New Employee',
            'user_name' => $user_name
        ]);
    }
    #[Route('/create/new/employeer', name: 'app_create_new_employeer', methods: ["POST"])]
    public function create(EntityManagerInterface $entityManager, Request $request): Response
    {
        $session = new Session();
        if($session->get('role') == 1){
            $employee = new Employee();
            $employee->setLastName($request->get('lastname'));
            $employee->setFirstName($request->get('firstname'));
            $employee->setPatronymic($request->get('patronymic'));
            $employee->setSalary($request->get('salary'));
            $entityManager->persist($employee);
            $entityManager->flush();
        }
        return $this->redirect("/get/all/employeers");
    }
}
