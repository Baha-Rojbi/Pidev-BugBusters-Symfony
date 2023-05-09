<?php

namespace App\Form;

use App\Entity\Type;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class TypeForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('category', TextType::class, [
                'constraints' => [
                    new NotBlank(message: "La category ne peut pas être vide"),
                    new Length([
                        'min' => 3,
                        'max' => 255,
                        'minMessage' => 'La category doit comporter au moins {{ limit }} caractères',
                        'maxMessage' => 'La category  ne peut pas dépasser {{ limit }} caractères',
                    ]),
                ],
            ])
            
            
            
            
            
            
            
            

            ->add('descprition', TextType::class, [
                'constraints' => [
                    new NotBlank(message: "La description ne peut pas être vide"),
                    new Length([
                        'min' => 3,
                        'max' => 255,
                        'minMessage' => 'La description doit comporter au moins {{ limit }} caractères',
                        'maxMessage' => 'La description ne peut pas dépasser {{ limit }} caractères',
                    ]),
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Type::class,
        ]);
    }
}
