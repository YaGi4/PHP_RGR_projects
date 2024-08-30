<?php

namespace App\Controller;

use App\Entity\Job;
use App\Entity\TypeWorks;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;

class CreateNewJobController extends AbstractController
{
    #[Route('/create/new/job', name: 'app_create_new_job', methods: ["GET"])]
    public function show(EntityManagerInterface $entityManager): Response
    {
        $session = new Session();
        $user_name = $session->get('name');
        $types = $entityManager->getRepository(TypeWorks::class)->findAll();
        return $this->render('create_new_job/index.html.twig', [
            'page_title' => 'New Job',
            'user_name' => $user_name,
            'types' => $types
        ]);
    }
    #[Route('/create/new/job', name: 'app_create_new_job', methods: ["POST"])]
    public function create(EntityManagerInterface $entityManager, Request $request): Response
    {
        $session = new Session();
        if($session->get('role') == 1){
            $job = new Job();
            $job->setIdTypeWork($request->get('type'));
            $job->setDuration($request->get('durationhrs'));
            $job->setDateBeginning(new \DateTime(date('Y-m-d H:i:s', strtotime($request->request->get('start_date')))));
            $job->setDateEnd(new \DateTime(date('Y-m-d H:i:s', strtotime($request->request->get('expiration_date')))));

            $entityManager->persist($job);
            $entityManager->flush();
        }
        return $this->redirect("/get/all/jobs");
    }
}
