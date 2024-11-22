<?php

namespace App\Controller;

use App\Entity\AccesPmr;
use App\Entity\Gallery;
use App\Entity\Informations;
use App\Entity\Ouvertures;
use App\Entity\Saisons;
use App\Entity\TarifsGlobaux;
use App\Repository\AccesPmrRepository;
use App\Repository\CoordonneesMapRepository;
use App\Repository\GalleryRepository;
use App\Repository\ImagesRepository;
use App\Repository\InformationsRepository;
use App\Repository\LocatifsRepository;
use App\Repository\OuverturesRepository;
use App\Repository\SaisonsRepository;
use App\Repository\TarifsGlobauxRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\Validator\Constraints\Image;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\LessThanOrEqual;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\PositiveOrZero;
use Symfony\Component\Validator\Constraints\Type;

class AdministrationController extends AbstractController
{
    #[Route('/administration', name: 'app_administration')]
    public function index(LocatifsRepository $locatifsRepository, ImagesRepository $imagesRepository, CoordonneesMapRepository $coordonneesMapRepository, SaisonsRepository $saisonsRepository, OuverturesRepository $ouverturesRepository, GalleryRepository $galleryRepository, InformationsRepository $informationsRepository, TarifsGlobauxRepository $tarifsGlobauxRepository, AccesPmrRepository $accesPmrRepository): Response
    {

        $locatifs = $locatifsRepository->findAll();
        $images = $imagesRepository->findAll();
        $emplacements = $coordonneesMapRepository->findAll();
        $saisons = $saisonsRepository->findAll();
        $ouvertures = $ouverturesRepository->findAll();
        $gallery = $galleryRepository->findAll();
        $informations = $informationsRepository->findAll();
        $tarifs = $tarifsGlobauxRepository->findAll();
        $accesPmr = $accesPmrRepository->findAll();

        //formulaire saisons..
        $saisonsEntity = new Saisons();

        $formSaisons = $this->createFormBuilder($saisonsEntity)
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
            'widget' => 'single_text',
            'input' => 'string',
            'label' => 'Début',
            'widget' => 'single_text',
            'row_attr' => array(
                'class' => 'row debut'
            ),
            'constraints' =>[
                new NotBlank(message: 'Doit être renseigné'),
                new Date()
            ]
        ])
        ->add('date_fin', DateType::class, [
            'widget' => 'single_text',
            'input' => 'string',
            'label' => 'Fin',
            'widget' => 'single_text',
            'row_attr' => array(
                'class' => 'row fin'
            ),
            'constraints' =>[
                new NotBlank(message: 'Doit être renseigné'),
                new Date()
            ]
        ])
        ->add('id', HiddenType::class)
        ->add('save', SubmitType::class, [
            'label' => 'Confirmer',
            'row_attr' => [
                'class' => 'row submit'
            ]
        ])
        ->getForm();

        //formulaire ouverture..
        $ouverturesEntity = new Ouvertures();

        $formOuvertures = $this->createFormBuilder($ouverturesEntity)
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
        ->add('choice_type', ChoiceType::class, [
            'label' => 'Ouverture',
            'mapped' => false,
            'attr' => [
                'class' => 'container-radio'
            ],
            'row_attr' => [
                'class' => 'row choice'
            ],
            'choices' => [
                'Oui' => 'oui',
                'Non' => 'non',
                'Sur réservation' => 'resa'
            ],
            'expanded' => true,
            'multiple' => false,
            'constraints' => [
                new NotBlank(message: 'Doit être renseigné'),
            ]
        ])
        ->add('save', SubmitType::class, [
            'label' => 'Confirmer',
            'row_attr' => [
                'class' => 'row submit'
            ]
        ])
        ->getForm();

        //formulaire galerie..
        $galleryEntity = new Gallery();

        $formGallery = $this->createFormBuilder($galleryEntity)
        ->add('img_url', FileType::class, [
            'label' => 'Importer*',
            'row_attr' => [
                'class' => 'row img'
            ],
            'mapped' => false,
            'multiple' => false,
            'constraints' => [
                new NotBlank(message: 'Doit être renseigné'),
                new Image(
                    maxRatio: 1.78,
                    maxRatioMessage: 'Le format doit être entre 1:1 et 16:9',
                    allowPortrait: false,
                    allowPortraitMessage: 'Le format doit être entre 1:1 et 16:9',
                    mimeTypes: [
                        'image/jpeg'
                    ],
                    mimeTypesMessage: 'Format obligatoire: JPEG'
                )
            ]
        ])
        ->add('save', SubmitType::class, [
            'label' => 'Confirmer',
            'row_attr' => [
                'class' => 'row submit'
            ]
        ])
        ->getForm();

        //formulaire info..
        $informationsEntity = new Informations();

        $formInfo = $this->createFormBuilder($informationsEntity)
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
        ->add('contenu', TextareaType::class, [
            'label' => 'Contenu',
            'attr' => [
                'minLength' => 1,
                'maxLength' => 200
            ],
            'row_attr' => [
                'class' => 'row contenu'
            ],
            'constraints' => [
                new NotBlank(message: 'Doit être renseigné'),
                new Length(
                    min: 1,
                    max: 200,
                    minMessage: 'Au moins {{ limit }} caractère',
                    maxMessage: 'Pas plus de {{ limit }} caractères'
                )
            ],
        ])
        ->add('save', SubmitType::class, [
            'label' => 'Confirmer',
            'row_attr' => [
                'class' => 'row submit'
            ]
        ])
        ->getForm();

        //formulaire tarifs globaux
        $tarifsEntity = new TarifsGlobaux();

        $formTarifs = $this->createFormBuilder($tarifsEntity)
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
        ->add('save', SubmitType::class, [
            'label' => 'Confirmer',
            'row_attr' => [
                'class' => 'row submit'
            ]
        ])
        ->getForm();

        //formulaire acces pmr..
        $accesPmrEntity = new AccesPmr();

        $formAccesPmr = $this->createFormBuilder($accesPmrEntity)
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
        ->add('save', SubmitType::class, [
            'label' => 'Confirmer',
            'row_attr' => [
                'class' => 'row submit'
            ]
        ])
        ->getForm();

        return $this->render('pages/administration/admin.html.twig', [
            'locatifs' => $locatifs,
            'images' => $images,
            'emplacements' => $emplacements,
            'saisons' => $saisons,
            'ouvertures' => $ouvertures,
            'gallery' => $gallery,
            'informations' => $informations,
            'tarifs' => $tarifs,
            'accesPmr' => $accesPmr,
            'formSaisons' => $formSaisons,
            'formOuvertures' => $formOuvertures,
            'formGallery' => $formGallery,
            'formInfo' => $formInfo,
            'formTarifs' => $formTarifs,
            'formAccesPmr' => $formAccesPmr

        ]);
    }
}
