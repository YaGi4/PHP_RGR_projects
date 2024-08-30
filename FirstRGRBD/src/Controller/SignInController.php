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
    public function getSignInPage(): Response
    {
        $session = new Session();
        $userName = $session->get("name");
        return $this->render('sign_in/index.html.twig', [
            'page_title' => "Sign in",
            'userName' => $userName
        ]);
    }
    #[Route('/sign/in', name: 'app_sign_in', methods: ["POST"])]
    public function signIn(EntityManagerInterface $entityManager, Request $request): Response
    {
        $name = $request->get('name');
        $password = $request->get('password');
        $user = $entityManager->getRepository(User::class)->findUserByNameAndPassword($name, $password);
        if($user != null){
            $session = new Session();
            $session->set("name", $user[0]->getName());
            if($user[0]->getRole() == 1){
                $session->set("role", "admin");
            }
            else
                $session->set("role", "enjoyer");
            return $this->redirect('/get/all/clients');
        }
        else
            return $this->redirect('/sign/in');
    }
}
