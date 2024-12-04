<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\PositiveOrZero;
use Symfony\Component\Validator\Constraints\Type;

class TarifsGlobauxType extends AbstractType
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
        ->add('valeur', NumberType::class, [
            'label' => 'Valeur*',
            'scale' => 2,
            'attr' => [
                'step' => 0.01,
                'min' => 0,
            ],
            'constraints' => [
                new NotBlank(message: 'Doit être renseigné'),
                new Type([
                    'type' => 'float',
                    'message' => 'Format accepté: 1.00'
                ]),
                new PositiveOrZero(message: 'Minimum: 0.00')
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
            'csrf_field_name' => '_tarifs_token'
        ]);
    }
}
