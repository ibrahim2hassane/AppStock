<?php

namespace App\Controller;

use App\Entity\Entree;
use App\Entity\Produit;
use App\Form\EntreeType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EntreeController extends AbstractController
{
    #[Route('/entree', name: 'entree_liste')]
    public function index(ManagerRegistry $doctrine)
    {
        $em= $doctrine->getManager();
        $e = new Entree();
        $form = $this->createForm(EntreeType::class, $e, array('action'=> $this->generateUrl('entree_add')));
        $data['form'] =$form->createView();
        $data['entrees'] = $em->getRepository(Entree::class)->findAll();
        return $this->render('entree/liste.html.twig',$data);
    }

    #[Route('/entree/add', name: 'entree_add')]
    public function add( ManagerRegistry $doctrine,Request $request,): Response
    {
        $em= $doctrine->getManager();
        $e = new Entree();
        $p = new Produit();
        $form= $this->createForm(EntreeType::class, $e);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $e = $form->getData();
            $em->persist($e);
            $em->flush();
            //mise à jour du produit.
            $p = $em->getRepository(Produit::class)->find($e->getProduit()->getId());
            $stock = $p->getStock() + $e->getQtite();
            $p->setStock($stock);
            $em  ->flush();

        }
        return $this->redirectToRoute(route:'entree_liste');
    }
}
