<?php

namespace App\Form;

use App\Entity\Reservations;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Choice;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ReservationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date_res')
            ->add('prix_res', ChoiceType::class, [
                'choices' => [
                    '50' => '50',
                    '100' => '100',
                    '200' => '200',
                    '250' => '250',

                ],
                'placeholder' => 'Choississez  le prix',
            ])
            ->add('utilisateur')
            ->add('Abonnements')
            ->add('evenement')
            ->add('nbplaces');
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reservations::class,
        ]);
    }
}
