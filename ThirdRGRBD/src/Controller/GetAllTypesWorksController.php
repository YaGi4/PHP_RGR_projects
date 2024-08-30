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

class GetAllTypesWorksController extends AbstractController
{
    #[Route('/get/all/types/works', name: 'app_get_all_types_works', methods: ["GET"])]
    public function show(EntityManagerInterface $entityManager): Response
    {
        $session = new Session();
        $user_name = $session->get('name');
        $types = $entityManager->getRepository(TypeWorks::class)->findAll();
        return $this->render('get_all_types_works/index.html.twig', [
            'page_title' => 'All Types Works',
            'user_name' => $user_name,
            'types' => $types,

        ]);
    }
    #[Route('/get/all/types/works', name: 'app_get_all_types_works', methods: ["POST"])]
    public function delete(EntityManagerInterface $entityManager, Request $request): Response
    {
        $session = new Session();
        if($session->get('role') == 1){
            if($entityManager->getRepository(Job::class)->findByTypeId($request->get('id')) == null){
                $entityManager->getRepository(TypeWorks::class)->delete($request->get('id'));
            }
        }
        return $this->redirect("/get/all/types/works");
    }
}
