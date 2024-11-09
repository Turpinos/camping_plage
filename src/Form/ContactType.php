<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label'=> 'Nom',
                'attr' => array(
                    'placeholder' => 'Dupont',
                    'autocomplete' => 'family-name',
                    'minlength' => '2',
                    'maxlength' => '50'
                ),
                'row_attr' => array(
                    'class' => 'row name'
                ),
                'constraints' => [
                    new NotBlank( message: 'Ce champ doit être renseigné'),
                    new Length(
                        min: 2,
                        minMessage: '{{ limit }} caractères minimum',
                        max: 50,
                        maxMessage: '{{ limit }} caractères maximum'
                    )
                ]
                
            ])
            ->add('firstName', TextType::class, [
                'label' => 'Prénom',
                'attr' => array(
                    'placeholder' => 'Jacques',
                    'autocomplete' => 'given-name',
                    'minlength' => '2',
                    'maxlength' => '50'
                ),
                'row_attr' => array(
                    'class' => 'row firstname'
                ),
                'constraints' => [
                    new NotBlank( message: 'Ce champ doit être renseigné'),
                    new Length(
                        min: 2,
                        minMessage: '{{ limit }} caractères minimum',
                        max: 50,
                        maxMessage: '{{ limit }} caractères maximum'
                    )
                ]
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email',
                'attr' => array(
                    'placeholder' => 'email@exemple.com',
                    'autocomplete' => 'email'
                ),
                'row_attr' => array(
                    'class' => 'row email'
                ),
                'constraints' => [
                    new NotBlank( message: 'Ce champ doit être renseigné'),
                    new Email(message: 'L\'email n\'est pas valide')
                ]
            ])
            ->add('subject', TextType::class, [
                'label' => 'sujet',
                'attr' => [
                    'placeholder' => 'Motif de votre message',
                    'min' => '2',
                    'max' => '100'
                ],
                'row_attr' => array(
                    'class' => 'row subject'
                ),
                'constraints' => [
                    new NotBlank(message: 'Ce champ doit être renseigné'),
                    new Length(
                        min:2,
                        minMessage: '{{ limit }} caractères minimum',
                        max:100,
                        maxMessage: '{{ limit }} caractères maximum'
                        )
                ]
            ])
            ->add('message', TextareaType::class, [
                'label' => 'Votre message',
                'attr' => [
                    'min' => '2',
                    'max' => '2000'
                ],
                'row_attr' => [
                    'class' => 'row message'
                ],
                'constraints' => [
                    new NotBlank(message: 'Ce champ doit être renseigné'),
                    new Length(
                        min:2,
                        minMessage: '{{ limit }} caractères minimum',
                        max:2000,
                        maxMessage: '{{ limit }} caractères maximum'
                    )
                ]
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Envoyer',
                'row_attr' => array(
                    'class' => 'row container-button'
                )
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
