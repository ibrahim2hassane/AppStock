<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom',TextType::class, array('label' =>'Nom Utilisateur','attr'=>array('class'=>'form-control form-group')))
            ->add('prenom',TextType::class, array('label' =>'Prénom Utilisateur','attr'=>array('class'=>'form-control form-group')))
            ->add('email',TextType::class, array('label' =>'Email','attr'=>array('class'=>'form-control form-group')))
            ->add('valider' ,SubmitType::class, array('attr'=>array('class'=>'btn btn-success form-group')))

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
