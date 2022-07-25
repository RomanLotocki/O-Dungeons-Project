<?php

namespace App\Form;

use App\Entity\Ability;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class AbilityType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                "label" => "Nom"
            ])
            ->add('quickDescription', TextareaType::class, [
                "label" => "Description rapide du pouvoir"
            ])
            ->add('description', TextareaType::class, [
                "label" => "Description du pouvoir"
            ])
            ->add('incantationTime', TextareaType::class, [
                "label" => "Temps d'incantation"
            ])
            ->add('abilityRange', TextareaType::class, [
                "label" => "Portée"
            ])
            ->add('component', TextareaType::class, [
                "label" => "Composantes"
            ])
            ->add('duration', TextareaType::class, [
                "label" => "Durée"
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Ability::class,
        ]);
    }
}
