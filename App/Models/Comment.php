<?php

namespace App\Models;

use App\Core\Model;

class Comment extends Model
{
    protected ?int $id = null;
    protected ?string $user_name = null;
    protected ?int $recept_id = null;
    protected ?string $comment = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getUserName(): ?string
    {
        return $this->user_name;
    }

    public function setUserName(?string $user_name): void
    {
        $this->user_name = $user_name;
    }

    public function getReceptId(): ?int
    {
        return $this->recept_id;
    }

    public function setReceptId(?int $recept_id): void
    {
        $this->recept_id = $recept_id;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(?string $comment): void
    {
        $this->comment = $comment;
    }

}