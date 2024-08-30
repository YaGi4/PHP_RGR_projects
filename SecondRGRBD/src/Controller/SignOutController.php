<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;

class SignOutController extends AbstractController
{
    #[Route('/sign/out', name: 'app_sign_out')]
    public function index(): Response
    {
        $session = new Session();
        $session->clear();
        return $this->redirect('/create/new/agent');
    }
}
