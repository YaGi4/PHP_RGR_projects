<?php

namespace App\Controller;

use App\DTOs\JobDto;
use App\Entity\EmployeeWorks;
use App\Entity\Job;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;

class GetAllJobsController extends AbstractController
{
    #[Route('/get/all/jobs', name: 'app_get_all_jobs', methods: ["GET"])]
    public function show(EntityManagerInterface $entityManager): Response
    {
        $session = new Session();
        $user_name = $session->get('name');
        $jobs = JobDto::createFromEntities($entityManager, $entityManager->getRepository(Job::class)->findAll());
        return $this->render('get_all_jobs/index.html.twig', [
            'page_title' => 'All Jobs',
            'user_name' => $user_name,
            'jobs' => $jobs,

        ]);
    }
    #[Route('/get/all/jobs', name: 'app_get_all_jobs', methods: ["POST"])]
    public function delete(EntityManagerInterface $entityManager, Request $request): Response
    {
        $session = new Session();
        if($session->get('role') == 1){
            if($entityManager->getRepository(EmployeeWorks::class)->findByJobId($request->get('id')) == null){
                $entityManager->getRepository(Job::class)->delete($request->get('id'));
            }
        }
        return $this->redirect("/get/all/jobs");
    }
}
