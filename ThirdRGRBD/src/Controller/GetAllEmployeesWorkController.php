<?php

namespace App\Controller;

use App\DTOs\EmWDto;
use App\Entity\Employee;
use App\Entity\EmployeeWorks;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;

class GetAllEmployeesWorkController extends AbstractController
{
    #[Route('/get/all/employees/work', name: 'app_get_all_employees_work', methods: ["GET"])]
    public function show(EntityManagerInterface $entityManager): Response
    {
        $employeesWork = EmWDto::createFromEntities($entityManager, $entityManager->getRepository(EmployeeWorks::class)->findAll());
        $session = new Session();
        $user_name = $session->get('name');
        return $this->render('get_all_employees_work/index.html.twig', [
            'page_title' => 'All Employee',
            'user_name' => $user_name,
            'employees_work' => $employeesWork
        ]);
    }
    #[Route('/get/all/employees/work', name: 'app_get_all_employees_work', methods: ["POST"])]
    public function delete(EntityManagerInterface $entityManager, Request $request): Response
    {
        $session = new Session();
        if($session->get('role') == 1){
            $entityManager->getRepository(EmployeeWorks::class)->delete($request->get('id'));
        }
        return $this->redirect("/get/all/employees/work");
    }
}
