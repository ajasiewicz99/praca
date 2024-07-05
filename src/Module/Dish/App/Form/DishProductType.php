<?php

namespace App\Module\Dish\App\Form;

use App\Module\Dish\Domain\Entity\DishProduct;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Module\Dish\Domain\Entity\Product;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class DishProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('productId', HiddenType::class, [
                'mapped' => false, // Nie mapuj tego pola na encję DishProduct
            ])
            ->add('grams', NumberType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => DishProduct::class,
        ]);
    }
}
