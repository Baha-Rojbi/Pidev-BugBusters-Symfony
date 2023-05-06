<?php

namespace App\Form;

use App\Entity\Location;
use App\Entity\VoitureLocation;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\GreaterThan;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;


class LocationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('voitureLocation', EntityType::class, [
            'class' => VoitureLocation::class,
            'choice_label' => function ($voitureLocation) {
                return $voitureLocation->getMatricule().' - '.$voitureLocation->getModele();
            },
            'constraints' => [
                new NotBlank(),
            ],
            'empty_data' => '',
        ])
            ->add('dateDebut', DateType::class, [
                'widget' => 'single_text',
                'empty_data' => '',
                'constraints' => [
                    new GreaterThan('today'),
                ],
            ])
            ->add('dateFin', DateType::class, [
                'widget' => 'single_text',
                'empty_data' => '',
            ])
            ->add('prixLocation', HiddenType::class, [
                'mapped' => false,
                'data' => ($builder->getData()->getVoitureLocation() ? $builder->getData()->getVoitureLocation()->getPrixJour() * abs($builder->getData()->getDateDebut()->diff($builder->getData()->getDateFin())->days) : 0),
                'empty_data' => '',
            ])
            ->add('idClient', HiddenType::class, [
                'data' => '1',
            ]);



    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Location::class,
            'constraints' => [
                new Assert\Callback([$this, 'validateDates']),
            ],
        ]);
    }

    public function validateDates(Location $location, ExecutionContextInterface $context): void
    {
        $dateDebut = $location->getDateDebut();
        $dateFin = $location->getDateFin();

        if ($dateDebut >= $dateFin) {
            $context->buildViolation('The start date must be before the end date.')
                ->atPath('dateDebut')
                ->addViolation();
            return;
        }

        // Check if dateFin is greater than dateDebut
        if ($dateFin < $dateDebut) {
            $context->buildViolation('The end date must be greater than the start date.')
                ->atPath('dateFin')
                ->addViolation();
        }
    }
}
