<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Mime\MimeTypesInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\NotBlank;

class InventaireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('pdf_url', FileType::class, [
                'label' => 'Importer*',
                'row_attr' => [
                    'class' => 'row pdf'
                ],
                'attr' => [
                    'accept' => 'application/pdf'
                ],
                'multiple' => false,
                'constraints' => [
                    new NotBlank(message: 'Doit être renseigné'),
                    new File(
                        maxSize: '2m',
                        maxSizeMessage: 'Max {{ limit }}Mo',
                        mimeTypes: 'application/pdf',
                        mimeTypesMessage: 'Format obligatoire: PDF'
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
            'csrf_field_name' => '_inventaire_token'
        ]);
    }
}
