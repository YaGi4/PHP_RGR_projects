<?php

namespace App\Controller;

use App\Entity\Employee;
use App\Entity\EmployeeWorks;
use App\Entity\Job;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;

class CreateNewEmployeesWorkController extends AbstractController
{
    #[Route('/create/new/employees/work', name: 'app_create_new_employees_work', methods: ["GET"])]
    public function show(EntityManagerInterface $entityManager): Response
    {
        $employeers = $entityManager->getRepository(Employee::class)->findAll();
        $jobs = $entityManager->getRepository(Job::class)->findAll();
        $session = new Session();
        $user_name = $session->get('name');
        return $this->render('create_new_employees_work/index.html.twig', [
            'page_title' => 'New Employee works',
            'user_name' => $user_name,
            'employeers' => $employeers,
            'jobs' => $jobs
        ]);
    }
    #[Route('/create/new/employees/work', name: 'app_create_new_employees_work', methods: ["POST"])]
    public function create(EntityManagerInterface $entityManager, Request $request): Response
    {
        $session = new Session();
        if($session->get('role') == 1 || $session->get('role') == 2){
            $eW= new EmployeeWorks();
            $eW->setIdEmployee($request->get('employee'));
            $eW->setIdJob($request->get('job'));
            $entityManager->persist($eW);
            $entityManager->flush();
        }
        return $this->redirect("/get/all/employees/work");
    }
}
