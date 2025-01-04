<?php

namespace App\Models;

use App\Core\Model;

class Rating extends Model
{
    protected ?int $id = null;
    protected ?int $rating = null;
    protected ?int $recept_id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getRating(): ?int
    {
        return $this->rating;
    }

    public function setRating(?int $rating): void
    {
        $this->rating = $rating;
    }

    public function getReceptId(): ?int
    {
        return $this->recept_id;
    }

    public function setReceptId(?int $recept_id): void
    {
        $this->recept_id = $recept_id;
    }
}