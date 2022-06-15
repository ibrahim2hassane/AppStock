<?php

namespace App\Form;

use App\Entity\Produit;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Notifier\Texter;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Serializer\Annotation\Groups;

class ProduitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
           // ->add('libelle', TextType::class, array('label'=>'Libelle du produit', 'attr'=>array('require','class'=>'form-control form-group')))
            ->add( 'libelle' ,TextType::class, array('label' =>'Libelle du Produit','attr'=>array('class'=>'form-control form-group')))
            ->add( 'stock' ,TextType::class, array('label' =>'Quantité en stock','attr'=>array('class'=>'form-control form-group')))
            ->add('valider' ,SubmitType::class, array('attr'=>array('class'=>'btn btn-success form-group')))
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Produit::class,
        ]);
    }
}
