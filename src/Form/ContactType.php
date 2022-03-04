<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
           ->add('name', TextType::class, array('required' =>true,'attr' =>array('class' => 'form-control')))
            ->add('email', TextType::class, array('required' =>true,'attr' =>array('class' => 'form-control')))
            ->add('text', TextareaType::class, array('required' =>true,'attr' =>array('class' => 'form-control')))
            ->add('send', SubmitType::class, array('label' =>'Enviar','attr' =>array('class'=>'btn btn-primary mt-3')))
           
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
