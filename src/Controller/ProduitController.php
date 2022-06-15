<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Form\ProduitType;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\ProduitRepository;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProduitController extends AbstractController
{
    #[Route('/produit', name: 'produit_liste')]
    public function index(ManagerRegistry $doctrine)
    {
        $em= $doctrine->getManager();
        //$em = $this->getDoctrine()->getManager();
        $p = new Produit();
        $form = $this->createForm(ProduitType::class, $p, array('action'=> $this->generateUrl('produit_add')));
        $data['form'] =$form->createView();
        $data['produits'] = $em->getRepository(Produit::class)->findAll();
        return $this->render('produit/liste.html.twig',$data);
    }

    #[Route('/produit/get/{id}', name: 'produit_get')]
    public function getProduit($id)
    {

        return $this->render(view:'produit/liste.html.twig');
    }

    #[Route('/produit/add', name: 'produit_add')]
    public function add( ManagerRegistry $doctrine,Request $request,)
    {
        $em= $doctrine->getManager();
        $p = new Produit();
        $form= $this->createForm(ProduitType::class, $p);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $p = $form->getData();
           // $em = $this->getDoctrine()->getManager();
            $em->persist($p);
            $em->flush();
        }
        return $this->redirectToRoute(route:'produit_liste');
    }



}