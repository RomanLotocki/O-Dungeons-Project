<?php

namespace App\Form;

use App\Entity\Ability;
use App\Entity\Armor;
use App\Entity\PlayableClass;
use App\Entity\PlayableClassItem;
use App\Entity\Weapon;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class PlayableClassType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                "label" => "Nom de la classe"
            ])
            ->add('description', TextareaType::class, [
                "label" => "Description de la classe"
            ])
            ->add('lifeDice', TextType::class, [
                "label" => "Le dès de vie de la classe"
            ])
            ->add('imageFile', FileType::class, [
                "label" => "L'image de la classe",
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => [
                            'image/png',
                        ],
                        'mimeTypesMessage' => 'Please upload a valid PNG image', 
                    ])
                ], 
            ])
            ->add('quickDescription', TextareaType::class, [
                "label" => "Description rapide de la classe"
            ])
            ->add('abilities', EntityType::class, [
                'label' => 'Pouvoirs reliés à la classe',
                'class' => Ability::class,
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => true
            ])
            ->add('armors', EntityType::class, [
                'label' => 'Armures données par la classe',
                'class' => Armor::class,
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => true
            ])
            ->add('weapons', EntityType::class, [
                'class' => Weapon::class,
                'label' => "Armes données par la classe",
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => true
            ])
            ->add('playableClassItems', CollectionType::class, [
                'entry_type' => PlayableClassItemType::class,
                'label' => false,
                'allow_add' => true,
                'allow_delete' => true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => PlayableClass::class,
        ]);
    }
}
