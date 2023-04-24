<?php

namespace App\Form;

use App\Entity\Abonnements;
use App\Entity\Reservations;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Choice;

class AbonnementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date_ab')
            ->add('date_exp')
            ->add('categorie_ab', ChoiceType::class, [
                'choices' => [
                    'Gold' => 'Gold',
                    'Platinuim' => 'Platinuim',
                    'Silver' => 'Silver',
                ],
                'placeholder' => 'Choississez une categorie',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Abonnements::class,
        ]);
    }
}
