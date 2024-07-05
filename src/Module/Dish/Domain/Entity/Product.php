<?php

namespace App\Module\Dish\Domain\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: "App\Module\Dish\Infrastructure\Persistence\Doctrine\Repository\ProductDoctrineRepository")]
#[ORM\Table(name: 'products')]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "AUTO")]
    #[ORM\Column(type: "integer")]
    private $id;

    #[ORM\Column(type: "string", length: 255)]
    private $name;

    #[ORM\Column(type: "text", nullable: true)]
    private $description;

    #[ORM\Column(type: "string", length: 255, nullable: true)]
    private $image;

    #[ORM\Column(type: "decimal", precision: 10, scale: 2)]
    private $calories;

    #[ORM\Column(type: "decimal", precision: 10, scale: 2)]
    private $protein;

    #[ORM\Column(type: "decimal", precision: 10, scale: 2)]
    private $carbs;

    #[ORM\Column(type: "decimal", precision: 10, scale: 2)]
    private $fat;

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
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getImage(): string
    {
        return $this->image;
    }

    /**
     * @param string $image
     */
    public function setImage(string $image): void
    {
        $this->image = $image;
    }

    /**
     * @return float
     */
    public function getCalories(): float
    {
        return $this->calories;
    }

    /**
     * @param float $calories
     */
    public function setCalories(float $calories): void
    {
        $this->calories = $calories;
    }

    /**
     * @return float
     */
    public function getProtein(): float
    {
        return $this->protein;
    }

    /**
     * @param float $protein
     */
    public function setProtein(float $protein): void
    {
        $this->protein = $protein;
    }

    /**
     * @return float
     */
    public function getCarbs(): float
    {
        return $this->carbs;
    }

    /**
     * @param float $carbs
     */
    public function setCarbs(float $carbs): void
    {
        $this->carbs = $carbs;
    }

    /**
     * @return float
     */
    public function getFat(): float
    {
        return $this->fat;
    }

    /**
     * @param float $fat
     */
    public function setFat(float $fat): void
    {
        $this->fat = $fat;
    }
}

