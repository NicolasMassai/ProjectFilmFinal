<?php

namespace App\Model;

class SearchData
{
    /** @var int */
    public $page = 1;

    /** @var string */
    public string $q = '';

    public function getq(): ?int
    {
        return $this->q;
    }

    public function setq(int $q): self
    {
        $this->q = $q;

        return $this;
    }
public function __toString(){
    return $this->q; // Remplacer champ par une propriété "string" de l'entité
}
}