<?php

namespace App\Form;

use App\Entity\Categorie;
use App\Entity\Produit;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CategorieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('produit',EntityType::class, array('class'=>Produit::class,'label'=>'Libelle du Produit','attr'=>array('require'=>'require','class'=>'form-control form-group')))
            ->add('nom',TextType::class, array('label' =>'Nom du catégorie ','attr'=>array('class'=>'form-control form-group')))
            ->add('valider',SubmitType::class, array('attr'=>array('class'=>'btn btn-success form-group')))


        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Categorie::class,
        ]);
    }
}
