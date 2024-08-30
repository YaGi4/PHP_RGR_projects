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

class GetAllEmployeersController extends AbstractController
{
    #[Route('/get/all/employeers', name: 'app_get_all_emloyeers', methods: ["GET"])]
    public function show(EntityManagerInterface $entityManager): Response
    {
        $employeers = $entityManager->getRepository(Employee::class)->findAll();
        $session = new Session();
        $user_name = $session->get('name');
        return $this->render('get_all_employeers/index.html.twig', [
            'page_title' => 'All Employee',
            'user_name' => $user_name,
            'employeers' => $employeers
        ]);
    }
    #[Route('/get/all/employeers', name: 'app_get_all_emloyeers', methods: ["POST"])]
    public function delete(EntityManagerInterface $entityManager, Request $request): Response
    {
        $session = new Session();
        if($session->get('role') == 1){
            if($entityManager->getRepository(EmployeeWorks::class)->findByEmployeeId($request->get('id')) == null){
                $entityManager->getRepository(Employee::class)->delete($request->get('id'));
            }
        }
        return $this->redirect("/get/all/employeers");
    }
}
