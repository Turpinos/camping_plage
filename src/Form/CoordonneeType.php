<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\PositiveOrZero;

class CoordonneeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('emplacement', IntegerType::class, [
                'label' => 'Emplacement',
                'attr' => array(
                    'min' => '0'
                ),
                'row_attr' => array(
                    'class' => 'row emplacement'
                ),
                'constraints' => [
                    new PositiveOrZero(message: 'Ne peut être négatif')
                ]
            ])
            ->add('position', TextType::class, [
                'label' => 'Position',
                'attr' => [
                    'minLength' => 1,
                    'maxLength' => 50,
                    'disabled' => 'disabled'
                ],
                'row_attr' => [
                    'class' => 'row position'
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
            'csrf_field_name' => '_coordonne_token'
        ]);
    }
}
