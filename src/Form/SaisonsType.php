<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class SaisonsType extends AbstractType
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
        ->add('date_debut', DateType::class, [
            'label' => 'Début',
            'row_attr' => array(
                'class' => 'row debut'
            ),
            'constraints' =>[
                new NotBlank(message: 'Doit être renseigné'),
            ]
        ])
        ->add('date_fin', DateType::class, [
            'label' => 'Fin',
            'row_attr' => array(
                'class' => 'row fin'
            ),
            'constraints' =>[
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
            'csrf_field_name' => '_saisons_token'
        ]);
    }
}
