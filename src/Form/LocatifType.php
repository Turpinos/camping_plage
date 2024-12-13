<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\PositiveOrZero;

class LocatifType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('libelle', TextType::class, [
                'label' => 'Nom',
                'attr' => [
                    'minLength' => 1,
                    'maxLength' => 50
                ],
                'row_attr' => [
                    'class' => 'row libelle'
                ],
                'constraints' => [
                    new NotBlank(message: 'Doit être renseigné'),
                    new Length(
                        min: 1,
                        max: 50,
                        minMessage: 'Au moins {{ limit }} caractère',
                        maxMessage: 'Pas plus de {{ limit }} caractères'
                    )
                ],
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description',
                'attr' => [
                    'minLength' => 1,
                    'maxLength' => 2000
                ],
                'row_attr' => [
                    'class' => 'row description'
                ],
                'constraints' => [
                    new NotBlank(message: 'Doit être renseigné'),
                    new Length(
                        min: 1,
                        max: 2000,
                        minMessage: 'Au moins {{ limit }} caractère',
                        maxMessage: 'Pas plus de {{ limit }} caractères'
                    )
                ],
            ])
            ->add('capacite', TextType::class, [
                'label' => 'Capacite',
                'attr' => [
                    'minLength' => 1,
                    'maxLength' => 50
                ],
                'row_attr' => [
                    'class' => 'row capacite'
                ],
                'constraints' => [
                    new NotBlank(message: 'Doit être renseigné'),
                    new Length(
                        min: 1,
                        max: 50,
                        minMessage: 'Au moins {{ limit }} caractère',
                        maxMessage: 'Pas plus de {{ limit }} caractères'
                    )
                ],
            ])
            ->add('superficie', IntegerType::class, [
                'label' => 'Superficie',
                'required' => false,
                'attr' => array(
                    'min' => '0'
                ),
                'row_attr' => array(
                    'class' => 'row superficie'
                ),
                'constraints' => [
                    new PositiveOrZero(message: 'Ne peut être négatif')
                ]
            ])
            ->add('pmr_type', ChoiceType::class, [
                'label' => 'Adapté PMR',
                'attr' => [
                    'class' => 'container-radio'
                ],
                'row_attr' => [
                    'class' => 'row pmr-choice'
                ],
                'choices' => [
                    'Oui' => 'true',
                    'Non' => 'false',
                ],
                'expanded' => true,
                'multiple' => false,
                'constraints' => [
                    new NotBlank(message: 'Doit être renseigné'),
                ]
            ])
            ->add('hiver_type', ChoiceType::class, [
                'label' => 'Ouvert l\'hiver',
                'attr' => [
                    'class' => 'container-radio'
                ],
                'row_attr' => [
                    'class' => 'row hiver-choice'
                ],
                'choices' => [
                    'Oui' => 'true',
                    'Non' => 'false',
                ],
                'expanded' => true,
                'multiple' => false,
                'constraints' => [
                    new NotBlank(message: 'Doit être renseigné'),
                ]
            ])
            ->add('id', HiddenType::class, [
                'constraints' =>[
                    new NotBlank(message: 'Erreur sur la cible du formulaire')
                ]
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Confirmer',
                'row_attr' => [
                    'class' => 'row submit'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'csrf_field_name' => '_locatif_token'
        ]);
    }
}
