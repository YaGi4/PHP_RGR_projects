<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;

class HomePageController extends AbstractController
{
    #[Route('/home/page', name: 'app_home_page', methods: ["GET"])]
    public function showHomePage(): Response
    {
        $session = new Session();
        $userName = $session->get('name');
        return $this->render('home_page/index.html.twig', [
            'page_title' => "Home",
            'user_name' => $userName
        ]);
    }
}
