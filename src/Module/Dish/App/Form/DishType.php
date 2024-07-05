<?php

namespace App\Module\Dish\App\Form;

use App\Module\Dish\Domain\Entity\Dish;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class DishType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class)
            ->add('description', TextareaType::class)
            ->add('recipe', TextareaType::class)
            ->add('isPublic', CheckboxType::class, [
                'required' => false,
            ])
            ->add('dishProducts', CollectionType::class, [
                'entry_type' => DishProductType::class, // Twój formularz dla produktów w daniu
                'allow_add' => true,
                'by_reference' => true, // Potrzebne, jeśli chcesz aby formularz sam zarządzał kolekcją
                'label' => false,
            ])
            ->add('availableProducts', EntityType::class, [
                'class' => 'App\Module\Dish\Domain\Entity\Product',
                'choices' => $options['products'],
                'choice_label' => 'name',
                'multiple' => true,
                'mapped' => false,
                'required' => false,
                'label' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Dish::class,
            'products' => [],
        ]);
    }
}
