<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\PositiveOrZero;
use Symfony\Component\Validator\Constraints\Type;

class TarifsCabaneType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('caution', IntegerType::class, [
                'label' => 'Caution',
                'attr' => array(
                    'min' => '0'
                ),
                'row_attr' => array(
                    'class' => 'row caution'
                ),
                'constraints' => [
                    new PositiveOrZero(message: 'Ne peut être négatif')
                ]
            ])
            ->add('arrhes_jour', IntegerType::class, [
                'label' => 'Arrhes au jour en %',
                'attr' => array(
                    'min' => '0'
                ),
                'row_attr' => array(
                    'class' => 'row arrhes_jour'
                ),
                'constraints' => [
                    new PositiveOrZero(message: 'Ne peut être négatif')
                ]
            ])
            ->add('arrhes_semaine', IntegerType::class, [
                'label' => 'Arrhes à la semaine',
                'attr' => array(
                    'min' => '0'
                ),
                'row_attr' => array(
                    'class' => 'row arrhes_semaine'
                ),
                'constraints' => [
                    new PositiveOrZero(message: 'Ne peut être négatif')
                ]
            ])
            ->add('bs_nuitee_2', IntegerType::class, [
                'label' => 'Basse saison à 2',
                'attr' => array(
                    'min' => '0'
                ),
                'row_attr' => array(
                    'class' => 'row bs_nuitee_2'
                ),
                'constraints' => [
                    new PositiveOrZero(message: 'Ne peut être négatif')
                ]
            ])
            ->add('bs_nuitee_3', IntegerType::class, [
                'label' => 'Basse saison à 3',
                'attr' => array(
                    'min' => '0'
                ),
                'row_attr' => array(
                    'class' => 'row bs_nuitee_3'
                ),
                'constraints' => [
                    new PositiveOrZero(message: 'Ne peut être négatif')
                ]
            ])
            ->add('bs_nuitee_4', IntegerType::class, [
                'label' => 'Basse saison à 4',
                'attr' => array(
                    'min' => '0'
                ),
                'row_attr' => array(
                    'class' => 'row bs_nuitee_4'
                ),
                'constraints' => [
                    new PositiveOrZero(message: 'Ne peut être négatif')
                ]
            ])
            ->add('hs_nuitee_2', IntegerType::class, [
                'label' => 'Haute saison à 2',
                'attr' => array(
                    'min' => '0'
                ),
                'row_attr' => array(
                    'class' => 'row hs_nuitee_2'
                ),
                'constraints' => [
                    new PositiveOrZero(message: 'Ne peut être négatif')
                ]
            ])
            ->add('hs_nuitee_3', IntegerType::class, [
                'label' => 'Haute saison à 3',
                'attr' => array(
                    'min' => '0'
                ),
                'row_attr' => array(
                    'class' => 'row hs_nuitee_3'
                ),
                'constraints' => [
                    new PositiveOrZero(message: 'Ne peut être négatif')
                ]
            ])
            ->add('hs_nuitee_4', IntegerType::class, [
                'label' => 'Haute saison à 4',
                'attr' => array(
                    'min' => '0'
                ),
                'row_attr' => array(
                    'class' => 'row hs_nuitee_4'
                ),
                'constraints' => [
                    new PositiveOrZero(message: 'Ne peut être négatif')
                ]
            ])
            ->add('tv_jour', IntegerType::class, [
                'required' => false,
                'label' => 'Tv au jour',
                'attr' => array(
                    'min' => '0'
                ),
                'row_attr' => array(
                    'class' => 'row tv_jour'
                ),
                'constraints' => [
                    new PositiveOrZero(message: 'Ne peut être négatif')
                ]
            ])
            ->add('tv_semaine', IntegerType::class, [
                'required' => false,
                'label' => 'Tv à la semaine',
                'attr' => array(
                    'min' => '0'
                ),
                'row_attr' => array(
                    'class' => 'row tv_semaine'
                ),
                'constraints' => [
                    new PositiveOrZero(message: 'Ne peut être négatif')
                ]
            ])
            ->add('animaux', NumberType::class, [
                'required' => false,
                'label' => 'animaux',
                'scale' => 2,
                'attr' => [
                    'step' => 0.01,
                    'min' => 0,
                ],
                'constraints' => [
                    new Type([
                        'type' => 'float',
                        'message' => 'Valeur numérique seulement'
                    ]),
                    new PositiveOrZero(message: 'Minimum: 0')
                ]
            ])
            ->add('choice_type', ChoiceType::class, [
                'label' => 'Dej. inclu',
                'attr' => [
                    'class' => 'container-radio'
                ],
                'row_attr' => [
                    'class' => 'row choice'
                ],
                'choices' => [
                    'Oui' => 'true',
                    'Non' => 'false'
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
            'csrf_field_name' => '_tarifs-cabane_token'
        ]);
    }
}
