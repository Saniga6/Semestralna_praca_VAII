<?php
namespace App\Models;

use App\Core\Model;

/**
 * @var $image string - image of the recipe
 * @var $procedure string - procedure of making the recipe
 * @var $ingredients string - ingredients of the recipe
 * @var $name string - name of the recipe
 * @var $id int - id of the recipe
 */
class Recept extends Model
{
    protected ?int $id = null;
    protected ?string $name = null;
    protected ?string $ingredients = null;
    protected ?string $procedure = null;
    protected ?string $image = null;
    protected ?string $category = null;

    public function getCategories(): ?string
    {
        return $this->category;
    }

    public function setCategories(?string $categories): void
    {
        $this->category = $categories;
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    public function getIngredients(): ?string
    {
        return $this->ingredients;
    }

    public function setIngredients(?string $ingredients): void
    {
        $this->ingredients = $ingredients;
    }

    public function getProcedure(): ?string
    {
        return $this->procedure;
    }

    public function setProcedure(?string $procedure): void
    {
        $this->procedure = $procedure;
    }

    public function getImage(): string
    {
        return $this->image;
    }

    public function setImage(string $image): void
    {
        $this->image = $image;
    }

}

