<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    #[Route('/user', name: 'user_liste')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $em= $doctrine->getManager();
        //$em = $this->getDoctrine()->getManager();
        $u = new User();
        $form = $this->createForm(UserType::class, $u, array('action'=> $this->generateUrl('user_add')));
        $data['form'] =$form->createView();
        $data['users'] = $em->getRepository(User::class)->findAll();
        return $this->render('user/liste.html.twig',$data);
    }

    #[Route('/user/add', name: 'user_add')]
    public function add( ManagerRegistry $doctrine,Request $request,)
    {
        $em= $doctrine->getManager();
        $u = new User();
        $form= $this->createForm(UserType::class, $u);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $u = $form->getData();
           // $em = $this->getDoctrine()->getManager();
            $em->persist($u);
            $em->flush();
        }
        return $this->redirectToRoute(route:'user_liste');
    }
}
