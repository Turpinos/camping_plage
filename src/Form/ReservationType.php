<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\LessThanOrEqual;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Positive;
use Symfony\Component\Validator\Constraints\PositiveOrZero;

class ReservationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label'=> 'Nom',
                'attr' => array(
                    'placeholder' => 'Dupont',
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
                    'placeholder' => 'email@exemple.com'
                ),
                'row_attr' => array(
                    'class' => 'row email'
                ),
                'constraints' => [
                    new NotBlank( message: 'Ce champ doit être renseigné'),
                    new Email(message: 'L\'email n\'est pas valide')
                ]
            ])
            ->add('address', TextType::class, [
                'label' => 'Adresse postal complète',
                'attr' => array(
                    'placeholder' => '1 rue du feu 56320 mabelleville',
                    'minlength' => '10',
                    'maxlength' => '200'
                ),
                'row_attr' => array(
                    'class' => 'row address'
                ),
                'constraints' => [
                    new NotBlank( message: 'Ce champ doit être renseigné'),
                    new Length(
                        min: 10,
                        minMessage: '{{ limit }} caractères minimum',
                        max: 200,
                        maxMessage: '{{ limit }} caractères maximum'
                    )
                ]  
            ])
            ->add('phone', TelType::class,[
                'label' => 'Téléphone',
                'attr' => array(
                    'minlength' => '5',
                    'maxlength' => '20'
                ),
                'row_attr' => array(
                    'class' => 'row phone'
                ),
                'constraints' => [
                    new NotBlank( message: 'Ce champ doit être renseigné'),
                    new Length(
                        min: 5,
                        minMessage: '{{ limit }} caractères minimum',
                        max: 15,
                        maxMessage: '{{ limit }} caractères maximum'
                    )
                ]
            ])
            ->add('nombreVoyageurs', IntegerType::class, [
                'label'=> 'Nombre de voyageurs',
                'attr' => array(
                    'placeholder' => 'Entrez une quantité',
                    'min' => '1',
                    'max' => '20',
                    'value' => '1'
                ),
                'row_attr' => array(
                    'class' => 'row nbrvoyageurs'
                ),
                'constraints' => [
                    new NotBlank( message: 'Ce champ doit être renseigné'),
                    new Positive(message: 'Minimum 1 voyageur'),
                    new LessThanOrEqual(
                        value: 20,
                        message: ' Maximum 20 voyageurs'
                    )
                ]
            ])
            ->add('nombreAnimaux', IntegerType::class, [
                'label' => 'Nombre d\'animaux*',
                'attr' => array(
                    'placeholder' => 'Entrez une quantité',
                    'min' => '0',
                    'max' => '20'
                ),
                'row_attr' => array(
                    'class' => 'row nbranimaux'
                ),
                'constraints' => [
                    new PositiveOrZero(message: 'Ne peut être négatif'),
                    new LessThanOrEqual(
                        value: 20,
                        message: 'Maximum 20 animaux'
                    )
                ]
            ])
            ->add('ageDesVoyageurs1', ChoiceType::class, [
                'label' => 'Voyageur 1',
                'choices' => [
                    'Choisir une tranche d\'âge' => 0,
                    '0-3 ans' => 1,
                    '4-10 ans' => 2,
                    '11-17 ans' => 3,
                    '18-28 ans' => 4,
                    '+28 ans' => 5
                ],
                'row_attr' => array(
                    'class' => 'row age'
                )
            ])
            ->add('hiddenInputAge', HiddenType::class)
            ->add('chalet', CheckboxType::class, [
                'label' => 'Chalet',
                'value' => 'chalet',
                'row_attr' => array(
                    'class' => 'row chalet'
                )
            ])
            ->add('chaletGite', CheckboxType::class, [
                'label' => 'Chalet-gîte',
                'value' => 'chalet-gite',
                'row_attr' => array(
                    'class' => 'row gite'
                )
            ])
            ->add('cabane', CheckboxType::class, [
                'label' => 'Cabane',
                'value' => 'cabane',
                'row_attr' => array(
                    'class' => 'row cabane'
                )
            ])
            ->add('roulotte', CheckboxType::class, [
                'label' => 'Roulotte',
                'value' => 'roulotte',
                'row_attr' => array(
                    'class' => 'row roulotte'
                )
            ])
            ->add('campingCar', CheckboxType::class, [
                'label' => 'Camping-car',
                'value' => 'camping-car',
                'row_attr' => array(
                    'class' => 'row camping-car'
                )
            ])
            ->add('caravane', CheckboxType::class, [
                'label' => 'Caravane',
                'value' => 'caravane',
                'row_attr' => array(
                    'class' => 'row caravane'
                )
            ])
            ->add('tente', CheckboxType::class, [
                'label' => 'Tente',
                'value' => 'tente',
                'row_attr' => array(
                    'class' => 'row tente'
                )
            ])
            ->add('electricite', CheckboxType::class, [
                'label' => 'Electricité',
                'value' => 'electricite',
                'row_attr' => array(
                    'class' => 'row elec'
                )
            ])
            ->add('debutDuSejour', DateType::class, [
                'widget' => 'single_text',
                'input' => 'string',
                'label' => 'Début du séjour',
                'widget' => 'single_text',
                'row_attr' => array(
                    'class' => 'endrow debut'
                ),
                'constraints' =>[
                    new NotBlank( message: 'Ce champ doit être renseigné'),
                    new Date(message: 'Le format de date est invalide')
                ]
            ])
            ->add('finDuSejour', DateType::class, [
                'widget' => 'single_text',
                'input' => 'string',
                'label' => 'Fin du séjour',
                'widget' => 'single_text',
                'row_attr' => array(
                    'class' => 'endrow fin'
                ),
                'constraints' =>[
                    new NotBlank( message: 'Ce champ doit être renseigné'),
                    new Date(message: 'Le format de date est invalide')
                ]
            ])
            ->add('nombreVehicules', IntegerType::class, [
                'label'=> 'Nombre de véhicules',
                'attr' => array(
                    'placeholder' => 'Entrez une quantité',
                    'min' => '0',
                    'max' => '10',
                    'value' => '0'
                ),
                'row_attr' => array(
                    'class' => 'endrow nbrvehicules'
                ),
                'constraints' => [
                    new NotBlank(),
                    new PositiveOrZero(message: 'Ne peut être négatif'),
                    new LessThanOrEqual(
                        value: 10,
                        message: 'Ne peut excéder {{ limit }}'
                    )
                ]
            ])
            ->add('commentaire', TextareaType::class, [
                'label' => 'Commentaire*',
                'attr' => array(
                    'maxlength' => '2000'
                ),
                'row_attr' => array(
                    'class' => 'endrow commentaire'
                ),
                'constraints' => [
                    new Length(
                        max:2000,
                        maxMessage: 'Ne peut contenir plus de 2000 caractères'
                    )
                ]
            ])
            ->add('save', SubmitType::class, [
                'attr' => ['class' => 'button'],
                'row_attr' => array(
                    'class' => 'endrow container-button'
                )
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'required' => false,
            'allow_extra_fields' => true
            // Configure your form options here
        ]);
    }
}
