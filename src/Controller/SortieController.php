<?php

namespace App\Controller;

use App\Entity\Sortie;
use App\Form\SortieType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Routing\Annotation\Route;

class SortieController extends AbstractController
{
    #[Route('/sortie', name: 'sortie_liste')]
    public function index(ManagerRegistry $doctrine)
    {
        $em= $doctrine->getManager();
        //$em = $this->getDoctrine()->getManager();
        $s = new Sortie();
        $form = $this->createForm(SortieType::class, $s, array('action'=> $this->generateUrl('sortie_add')));
        $data['form'] =$form->createView();
        $data['sorties'] = $em->getRepository(Sortie::class)->findAll();
        return $this->render('sortie/liste.html.twig',$data);
    }

    #[Route('/sortie/add', name: 'sortie_add')]
    public function add( ManagerRegistry $doctrine,Request $request,)
    {
        $em= $doctrine->getManager();
        $s = new Sortie();
        $form= $this->createForm(SortieType::class, $s);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $s = $form->getData();
           // $em = $this->getDoctrine()->getManager();
            $em->persist($s);
            $em->flush();
           
        }
        return $this->redirectToRoute(route:'sortie_liste');
    }
}
