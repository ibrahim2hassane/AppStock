<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LogonController extends AbstractController
{
    #[Route('/logon', name: 'logon')]
    public function index(): Response
    {
        return $this->render('accueil.html.twig', [
            'controller_name' => 'LogonController',
        ]);
    }
}
