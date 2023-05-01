<?php

namespace App\Form;

use App\Entity\Nourritures;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\Type;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class NourrituresType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom_nourriture')
            ->add('origine_nourriture', ChoiceType::class, [
                'choices' => [
                    "" => "",
                    "Tunis"  => "Tunis",
                    "Bizerte"  => "	Bizerte",
                    "Gabès"  => "Gabès",
                    "Gafsa"  => "Gafsa",
                    "Jendouba"  => "Jendouba",
                    "Hammamet"  => "Hammamet",
                    "Djerba"  => "Djerba",
                    "Kairouan"  => "Kairouan",
                    "Kasserine"  => "Kasserine",
                    "Kébili"  => "Kébili",
                    "Le Kef"  => "Le Kef",
                    "Mahdia"  => "Mahdia",
                    "La Manouba"  => "La Manouba",
                ]])
            ->add('ingrediant')
            ->add('prix_nourriture',  NumberType::class, [
                'html5' => true,
                'attr' => [
                    'pattern' => '[0-9]+([\.|,][0-9]+)?'
                ]
            ])
            ->add('description_nourriture')
            ->add('type_nourriture')
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
            ])
            ->add('utilisateur')
            ->add('civilisation')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Nourritures::class,
        ]);
    }
}
