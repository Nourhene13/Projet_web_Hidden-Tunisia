<?php

namespace App\Form;

use App\Entity\Evenements;
use Symfony\Component\Intl\Countries;
use App\Validator\NoInappropriateWords;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class EvenementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre_evenement')
            ->add('type_evenement')
            ->add('date_evenement', DateType::class, [
                'widget' => 'single_text',
            ])
            ->add('lieux_evenement', ChoiceType::class, [
                'label' => 'Select a country',
                'choices' => array_flip(Countries::getNames()),
            ])
            ->add('prix_evenement')
            ->add(
                'description_evenement',
                TextType::class,
                ['constraints' => [new NoInappropriateWords(),],]
            )
            ->add('image', FileType::class, [
                'label' => 'image (img file)',

                // unmapped means that this field is not associated to any entity property
                'mapped' => false,

                // make it optional so you don't have to re-upload the PDF file
                // every time you edit the Product details
                'required' => false,

                // unmapped fields can't define their validation using annotations
                // in the associated entity, so you can use the PHP constraint classes
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => [
                            'image/jpg',
                            'image/jpeg',
                            'image/gif',
                            'image/png',
                        ],
                        'mimeTypesMessage' => 'Please upload a valid image document',
                    ])
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Evenements::class,
        ]);
    }
}
