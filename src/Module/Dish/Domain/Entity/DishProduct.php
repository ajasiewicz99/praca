<?php

namespace App\Module\Dish\Domain\Entity;

use Doctrine\ORM\Mapping as ORM;


#[ORM\Entity('dish_products')]
class DishProduct
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private $id;

    #[ORM\ManyToOne(targetEntity: "Dish", inversedBy: "dishProducts")]
    #[ORM\JoinColumn(nullable: false)]
    private $dish;

    #[ORM\ManyToOne(targetEntity:"Product")]
    #[ORM\JoinColumn(nullable:false)]
    private $product;

    #[ORM\Column(type:"integer")]
    private $grams;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDish(): ?Dish
    {
        return $this->dish;
    }

    public function setDish(?Dish $dish): self
    {
        $this->dish = $dish;

        return $this;
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): self
    {
        $this->product = $product;

        return $this;
    }

    public function getGrams(): ?int
    {
        return $this->grams;
    }

    public function setGrams(int $grams): self
    {
        $this->grams = $grams;

        return $this;
    }
}

