<?php

namespace App\Controller;
use App\Entity\Categorie;
use App\Entity\Produit;
use App\Form\CategorieType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CategorieController extends AbstractController
{
    #[Route('/categorie', name: 'categorie_liste')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $em= $doctrine->getManager();
        $c = new Categorie();
        $form = $this->createForm(CategorieType::class, $c, array('action'=> $this->generateUrl('categorie_add')));
        $data['form'] =$form->createView();
        $data['categories'] = $em->getRepository(Categorie::class)->findAll();
        return $this->render('categorie/liste.html.twig',$data);
    }

    #[Route('/categorie/add', name: 'categorie_add')]
    public function add( ManagerRegistry $doctrine,Request $request,): Response
    {
        $em= $doctrine->getManager();
        $c = new Categorie();
        $p = new Produit();
        $form= $this->createForm(CategorieType::class, $c);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $e = $form->getData();
            $em->persist($e);
            $em->flush();
        }
        return $this->redirectToRoute(route:'categorie_liste');
    }
}
