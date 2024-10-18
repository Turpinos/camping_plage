<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

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
                )
                
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
                )
            ])
            ->add('address', TextType::class, [
                'label' => 'Adresse postal complète',
                'attr' => array(
                    'placeholder' => '1 rue du feu 56320 mabelleville',
                    'minlength' => '2',
                    'maxlength' => '200'
                ),
                'row_attr' => array(
                    'class' => 'row address'
                )  
            ])
            ->add('phone', TelType::class,[
                'label' => 'Téléphone',
                'attr' => array(
                    'minlength' => '2',
                    'maxlength' => '20'
                ),
                'row_attr' => array(
                    'class' => 'row phone'
                )
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
                )
            ])
            ->add('nombreAnimaux', IntegerType::class, [
                'label' => 'Nombre d\'animaux',
                'attr' => array(
                    'placeholder' => 'Entrez une quantité',
                    'min' => '0',
                    'max' => '10'
                ),
                'row_attr' => array(
                    'class' => 'row nbranimaux'
                )
            ])
            ->add('ageDesVoyageurs', ChoiceType::class, [
                'label' => 'Voyageur 1',
                'choices' => [
                    'Choisir une tranche d\'âge' => null,
                    '0-3 ans' => '0-3',
                    '4-10 ans' => '4-10',
                    '11-17 ans' => '11-17',
                    '18-28 ans' => '18-28',
                    '+28 ans' => '+28'
                ],
                'row_attr' => array(
                    'class' => 'row age'
                )
            ])
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
                'label' => 'Début du séjour',
                'widget' => 'single_text',
                'row_attr' => array(
                    'class' => 'row debut'
                )
            ])
            ->add('finDuSejour', DateType::class, [
                'label' => 'Fin du séjour',
                'widget' => 'single_text',
                'row_attr' => array(
                    'class' => 'row fin'
                )
            ])
            ->add('nombreVehicules', IntegerType::class, [
                'label'=> 'Nombre de véhicules',
                'attr' => array(
                    'placeholder' => 'Entrez une quantité',
                    'min' => '0',
                    'max' => '10'
                ),
                'row_attr' => array(
                    'class' => 'row nbrvehicules'
                )
            ])
            ->add('commentaire', TextareaType::class, [
                'label' => 'Commentaire',
                'attr' => array(
                    'placeholder' => 'Ajoutez des précisions',
                    'maxlength' => '2000'
                ),
                'row_attr' => array(
                    'class' => 'row commentaire'
                )
            ])
            ->add('Envoyer', ButtonType::class, [
                'attr' => ['class' => 'button']
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
