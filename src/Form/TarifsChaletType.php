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

class TarifsChaletType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('hs_semaine', IntegerType::class, [
                'label' => 'Semaine haute saison',
                'attr' => array(
                    'min' => '0'
                ),
                'row_attr' => array(
                    'class' => 'row hs_semaine'
                ),
                'constraints' => [
                    new PositiveOrZero(message: 'Ne peut être négatif')
                ]
            ])
            ->add('bs_nuitee', IntegerType::class, [
                'label' => 'Nuitée basse saison',
                'attr' => array(
                    'min' => '0'
                ),
                'row_attr' => array(
                    'class' => 'row bs_nuitee'
                ),
                'constraints' => [
                    new PositiveOrZero(message: 'Ne peut être négatif')
                ]
            ])
            ->add('bs_semaine', IntegerType::class, [
                'label' => 'Semaine basse saison',
                'attr' => array(
                    'min' => '0'
                ),
                'row_attr' => array(
                    'class' => 'row bs_semaine'
                ),
                'constraints' => [
                    new PositiveOrZero(message: 'Ne peut être négatif')
                ]
            ])
            ->add('hv_nuitee', IntegerType::class, [
                'label' => 'Nuitée hiver',
                'required' => false,
                'attr' => array(
                    'min' => '0'
                ),
                'row_attr' => array(
                    'class' => 'row hv_nuitee'
                ),
                'constraints' => [
                    new PositiveOrZero(message: 'Ne peut être négatif')
                ]
            ])
            ->add('hv_semaine', IntegerType::class, [
                'label' => 'Semaine hiver',
                'required' => false,
                'attr' => array(
                    'min' => '0',
                ),
                'row_attr' => array(
                    'class' => 'row hv_semaine'
                ),
                'constraints' => [
                    new PositiveOrZero(message: 'Ne peut être négatif')
                ]
            ])
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
            ->add('tv_jour', IntegerType::class, [
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
                'label' => 'animaux',
                'scale' => 2,
                'attr' => [
                    'step' => 0.01,
                    'min' => 0,
                ],
                'constraints' => [
                    new NotBlank(message: 'Doit être renseigné'),
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
            'csrf_field_name' => '_tarifs_token'
        ]);
    }
}
