<?php

namespace App\Models;

class Save extends Model
{
    protected ?int $id = null;
    protected ?int $user_id = null;
    protected ?int $recept = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getUserId(): ?int
    {
        return $this->user_id;
    }

    public function setUserId(?int $user_id): void
    {
        $this->user_id = $user_id;
    }

    public function getRecept(): ?int
    {
        return $this->recept;
    }

    public function setRecept(?int $recept): void
    {
        $this->recept = $recept;
    }

}