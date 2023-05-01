<?php

namespace App\Form;

use App\Entity\Abonnements;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class AbonnementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date_ab', DateType::class, [
                'widget' => 'single_text',
            ])
            ->add('date_exp', DateType::class, [
                'widget' => 'single_text',
            ])
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
