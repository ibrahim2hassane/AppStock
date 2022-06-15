<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RolesController extends AbstractController
{
    #[Route('/roles', name: 'role_liste')]
    public function index(): Response
    {
        return $this->render('role/liste.html.twig');
    }
}
