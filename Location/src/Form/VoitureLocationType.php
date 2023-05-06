<?php

namespace App\Form;

use App\Entity\VoitureLocation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Image;
use Symfony\Component\Validator\Constraints\Positive;



class VoitureLocationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('matricule', TextType::class, [
                'label' => 'Matricule',
                'attr' => [
                    'pattern' => '\d{3}TUN\d{4}',
                    'title' => 'The matricule should be in the format XXXTUNXXXX where X is a digit'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Matricule field should not be empty'
                    ])
                ]
            ])
            ->add('modele', TextType::class, [
                'label' => 'Modele',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Modele field should not be empty'
                    ])
                ]
            ])
            ->add('carteGrise', TextType::class, [
                'label' => 'Carte Grise',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Carte Grise field should not be empty'
                    ])
                ]
            ])
            ->add('prixJour', IntegerType::class, [
                'label' => 'Prix par jour',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Prix par jour field should not be empty'
                    ]),
                    new Positive([
                        'message' => 'Prix par jour should be positive'
                    ])
                ]
            ])
            ->add('imageVoiture', FileType::class, [
                'label' => 'Image de la voiture',
                'required' => false,
                'mapped' => false,
                'data_class' => null,
                'constraints' => [
                    new Image([
                        'maxSize' => '2M',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png',
                            'image/gif',
                        ],
                        'mimeTypesMessage' => 'Please upload a valid image (JPEG, PNG or GIF)',
                    ])
                ]
            ])

            ->add('idclient', IntegerType::class, [
                'label' => 'ID du client',
                'constraints' => [
                    new NotBlank([
                        'message' => 'id du client should not be empty'
                    ])
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => VoitureLocation::class,
        ]);
    }
}
