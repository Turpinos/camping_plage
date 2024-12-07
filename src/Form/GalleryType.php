<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Image;
use Symfony\Component\Validator\Constraints\NotBlank;

class GalleryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('img_url', FileType::class, [
            'label' => 'Importer*',
            'row_attr' => [
                'class' => 'row img'
            ],
            'attr' => [
                'accept' => 'image/jpeg'
            ],
            'multiple' => false,
            'constraints' => [
                new NotBlank(message: 'Doit être renseigné'),
                new Image(
                    allowPortrait: false,
                    allowPortraitMessage: 'Pas de portrait',
                    maxSize: '2M',
                    maxSizeMessage: 'Max {{ limit }}Mo',
                    mimeTypes: [
                        'image/jpeg'
                    ],
                    mimeTypesMessage: 'Format obligatoire: JPEG'
                )
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
            'csrf_field_name' => '_gallery_token'
        ]);
    }
}
