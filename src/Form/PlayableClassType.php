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
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PlayableClassType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class)
            ->add('description', TextareaType::class)
            ->add('lifeDice', TextType::class)
            ->add('imageUrl', UrlType::class)
            ->add('quickDescription', TextareaType::class)
            ->add('abilities', EntityType::class, [
                'class' => Ability::class,
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => true
            ])
            ->add('armors', EntityType::class, [
                'class' => Armor::class,
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => true
            ])
            ->add('weapons', EntityType::class, [
                'class' => Weapon::class,
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => true
            ])
            ->add('playableClassItems', CollectionType::class, [
                'entry_type' => PlayableClassItemType::class,
                'entry_options' => ['label' => false],
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
