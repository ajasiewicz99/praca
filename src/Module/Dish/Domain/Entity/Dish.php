<?php

namespace App\Module\Dish\Domain\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: "App\Module\Dish\Infrastructure\Persistence\Doctrine\Repository\DishDoctrineRepository")]
#[ORM\Table(name: "dishes")]
class Dish
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "AUTO")]
    #[ORM\Column(type: "integer")]
    private $id;

    #[ORM\Column(type: "string", length: 255)]
    private $name;

    #[ORM\Column(type: "string", length: 255, nullable: true)]
    private $image;

    #[ORM\Column(type: "text", nullable: true)]
    private $description;

    #[ORM\Column(type: "text", nullable: true)]
    private $recipe;

    #[ORM\Column(type: "boolean")]
    private $isPublic;

    #[ORM\OneToMany(targetEntity: "App\Module\Dish\Domain\Entity\DishProduct", mappedBy: "dish", cascade: ["persist", "remove"])] // Poprawka: dodanie pełnej ścieżki do encji DishProduct
    private $dishProducts;

    public function __construct()
    {
        $this->dishProducts = new ArrayCollection();
    }

    public function calculateMacros(): array
    {
        $totalCalories = 0;
        $totalProtein = 0;
        $totalCarbs = 0;
        $totalFat = 0;

        /** @var DishProduct $dishProduct */
        foreach ($this->dishProducts as $dishProduct) {
            $product = $dishProduct->getProduct();
            $grams = $dishProduct->getGrams();

            $totalCalories += number_format($product->getCalories() * ($grams / 100),1,'.','');
            $totalProtein += number_format($product->getProtein() * ($grams / 100),1,'.','');
            $totalCarbs += number_format($product->getCarbs() * ($grams / 100),1,'.','');
            $totalFat += number_format(($product->getFat() * ($grams / 100)),1,'.','');
        }

        return [
            'calories' => $totalCalories,
            'protein' => $totalProtein,
            'carbs' => $totalCarbs,
            'fat' => $totalFat,
        ];
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description): void
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getRecipe()
    {
        return $this->recipe;
    }

    /**
     * @param mixed $recipe
     */
    public function setRecipe($recipe): void
    {
        $this->recipe = $recipe;
    }

    /**
     * @return mixed
     */
    public function getIsPublic()
    {
        return $this->isPublic;
    }

    /**
     * @param mixed $isPublic
     */
    public function setIsPublic($isPublic): void
    {
        $this->isPublic = $isPublic;
    }

    /**
     * @return Collection|DishProduct[]
     */
    public function getDishProducts(): Collection
    {
        return $this->dishProducts;
    }

    public function addDishProduct(DishProduct $dishProduct): self
    {
        if (!$this->dishProducts->contains($dishProduct)) {
            $this->dishProducts[] = $dishProduct;
            $dishProduct->setDish($this);
        }

        return $this;
    }

    public function removeDishProduct(DishProduct $dishProduct): self
    {
        if ($this->dishProducts->contains($dishProduct)) {
            $this->dishProducts->removeElement($dishProduct);
            // set the owning side to null (unless already changed)
            if ($dishProduct->getDish() === $this) {
                $dishProduct->setDish(null);
            }
        }

        return $this;
    }
    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $image
     */
    public function setImage($image): void
    {
        $this->image = $image;
    }
}
