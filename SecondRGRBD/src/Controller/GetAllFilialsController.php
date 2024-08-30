<?php

namespace App\Controller;

use App\DTOs\FilialDto;
use App\Entity\Filial;
use App\Services\DeleteFililal;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;

class GetAllFilialsController extends AbstractController
{
    #[Route('/get/all/filials', name: 'app_get_all_filials', methods: ["GET"])]
    public function show(EntityManagerInterface $entityManager): Response
    {
        $session = new Session();
        $userName = $session->get("name");
        $filialsEntity = $entityManager->getRepository(Filial::class)->findAllFilials();
        $filials = FilialDto::createFromEntities($filialsEntity);
        return $this->render('get_all_filials/index.html.twig', [
            'page_title' => "Filials",
            'filials' => $filials,
            'userName' => $userName
        ]);
    }
    #[Route('/get/all/filials', name: 'app_get_all_filials', methods: ["POST"])]
    public function delete(EntityManagerInterface $entityManager, Request $request): Response
    {
        $session = new Session();
        if($session->get('role') == "admin"){
            DeleteFililal::delete($entityManager, $request);
        }
        return $this->redirect("/get/all/filials");
    }
}
