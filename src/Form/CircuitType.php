<?php

namespace App\Form;

use DateTime;
use App\Entity\Circuits;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class CircuitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('point_depat_circuit')
            ->add('date_debut_circuit', DateTimeType::class, [
                'widget' => 'single_text',
            ])
            ->add('date_fin_circuit', DateTimeType::class, [
                'widget' => 'single_text',
            ])
            ->add('nbr_place_dispo')
            ->add('description_circuit')
            ->add('nbr_jour_circuit')
            ->add('nom_circuit');
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Circuits::class,
        ]);
    }
}
