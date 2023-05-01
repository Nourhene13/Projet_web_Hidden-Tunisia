<?php

namespace App\Form;

use App\Entity\Reservations;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ReservationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date_res', DateType::class, [
                'widget' => 'single_text',
            ])
            ->add('prix_res', ChoiceType::class, [
                'choices' => [
                    '50' => '50',
                    '100' => '100',
                    '200' => '200',
                    '250' => '250',

                ],
                'placeholder' => 'Choississez  le prix',
            ])
            ->add('Abonnements')
            ->add('evenement');;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reservations::class,
        ]);
    }
}
