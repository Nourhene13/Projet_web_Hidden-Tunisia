<?php

namespace App\Form;

use App\Entity\Evenements;
use App\Validator\NoInappropriateWords;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Intl\Countries;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EvenementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre_evenement')
            ->add('type_evenement')
            ->add('date_evenement')
            ->add('lieux_evenement')
            ->add('lieux_evenement', ChoiceType::class, [
                'label' => 'Select a country',
                'choices' => array_flip(Countries::getNames()),
            ])
            ->add('prix_evenement')
            ->add('description_evenement', TextType::class, 
            [  'constraints' => [  new NoInappropriateWords(), ], ])
            ->add('image')
            ->add('utilisateur')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Evenements::class,
        ]);
    }
}
