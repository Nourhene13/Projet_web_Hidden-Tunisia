<?php

namespace App\Form;

use App\Entity\Circuits;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CircuitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('point_depat_circuit')
            ->add('date_debut_circuit')
            ->add('date_fin_circuit')
            ->add('nbr_place_dispo')
            ->add('description_circuit')
            ->add('nbr_jour_circuit')
            ->add('nom_circuit')
            ->add('utilisateur')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Circuits::class,
        ]);
    }
}
