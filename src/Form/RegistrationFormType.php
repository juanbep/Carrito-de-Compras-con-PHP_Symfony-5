<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        
        $entity = $builder->getData();
        
        $builder
            ->add('nombres', TextType::class, array('label' => 'Nombres', 'required' =>true, 'attr' =>array('class' => 'form-control')))
            ->add('apellidos', TextType::class, array('label' => 'Apellidos', 'required' =>true, 'attr' =>array('class' => 'form-control')))
            ->add('edad', NumberType::class, array('label' => 'Edad', 'required' =>true, 'attr' =>array('class' => 'form-control')))
            ->add('fechaNacimiento', DateType::class,[
                'label' => 'Fecha de nacimiento (yyyy-mm-dd)', 
                'required' =>true, 
                'placeholder' =>  'yyyy-mm-dd',
                
                'widget' => 'single_text',

                // prevents rendering it as type="date", to avoid HTML5 date pickers
                'html5' => false,

                // adds a class that can be selected in JavaScript
                'attr' => ['class' => 'js-datepicker'],
                ])
            ->add('email', EmailType::class, array('label' => 'Email', 'required' =>true, 'attr' =>array('class' => 'form-control')))
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'label' => 'Contraseña',
                'mapped' => false,
                'attr' =>array('autocomplete' => 'new-password', 'class' => 'form-control'),
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])    
            ->add('roles', ChoiceType::class, [
                'label' => 'Rol',
                'choices' => ['User' => 'ROLE_USER', 'Admin' => 'ROLE_ADMIN'],
                'attr' =>array('class' => 'form-check-inline'),
                'required' => true,
                'expanded' => true,
                'multiple' => true,
                'data' => $entity->getRoles() // Current roles assigned..
            ])    
            ->add('agreeTerms', CheckboxType::class,[
                'label' => 'Aceptar términos y condiciones',
                'required' => true,
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'You should agree to our terms.'
                    ])
                ]
            ])
            ->add('send', SubmitType::class, array('label' =>'Confirmar','attr' =>array('class'=>'btn btn-primary mt-3')))
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
