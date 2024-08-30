<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;

class SignInController extends AbstractController
{
    #[Route('/sign/in', name: 'app_sign_in', methods: ["GET"])]
    public function show(): Response
    {
        return $this->render('sign_in/index.html.twig', [
            'page_title' => "sign in",
            'user_name' => null
        ]);
    }
    #[Route('/sign/in', name: 'app_sign_in', methods: ["POST"])]
    public function signin(EntityManagerInterface $entityManager, Request $request): Response
    {
        $session = new Session();
        $user = $entityManager->getRepository(User::class)->findByNameAndPassword($request->get("name"), $request->get("password"));
        if($user != null){
            $session->set('name', $user[0]->getName());
            $session->set('role', $user[0]->getRole());
            return $this->redirect("/home/page");
        }
        else{
            return $this->redirect("/sign/in");
        }
    }
}
