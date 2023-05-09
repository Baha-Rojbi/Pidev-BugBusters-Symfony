<?php
namespace App\Form;
use App\Entity\Type;
use App\Entity\Event;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Validator\Constraints\GreaterThanOrEqual;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\Extension\Core\Type\{
    FileType,
    TextType,
    ButtonType,
    EmailType,
    HiddenType,
    PasswordType,
    TextareaType,
    SubmitType,
    NumberType,
    MoneyType,
    BirthdayType
};
use Symfony\Component\Validator\Constraints\NotBlank;



class EventForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('date', DateTimeType::class, [
            'date_widget' => 'single_text',
            
            'constraints' => [
              
                new GreaterThanOrEqual('today', message: 'La date ne peut pas être antérieure à aujourd\'hui.'),
                
            ],
        ])
            ->add(
                'description',
                 TextType::class, [
                    'constraints' => [
                        new NotBlank(message: "La description ne peut pas être vide"),
                        new Length([
                            'min' => 5,
                            'max' => 255,
                            'minMessage' => 'La description doit comporter au moins {{ limit }} caractères',
                            'maxMessage' => 'La description ne peut pas dépasser {{ limit }} caractères',
                        ]),
                    ],
                    
                ])

            ->add('nom',
            TextType::class, [
               'constraints' => [
                   new NotBlank(message: "Le nom ne peut pas être vide"),
                   new Length([
                       'min' => 5,
                       'max' => 255,
                       'minMessage' => 'Le nom doit comporter au moins {{ limit }} caractères',
                       'maxMessage' => 'Le nom ne peut pas dépasser {{ limit }} caractères',
                   ]),
               ],
           ])



            ->add('imageFile', FileType::class, [
                'mapped' => false,
                'required' => false,
            ])
            ->add('type', EntityType::class, [
                'label' => 'category',
                'class' => Type::class,
                'choice_label' => 'category',
                'placeholder' => 'Choisir le category '
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Event::class,
        ]);
    }
}
