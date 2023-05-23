<?php

namespace App\Entity;

use App\Repository\BankRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BankRepository::class)]
class Bank
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $account = null;

    #[ORM\OneToOne(inversedBy: 'bank', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?abonne $abonne = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAccount(): ?int
    {
        return $this->account;
    }

    public function setAccount(int $account): self
    {
        $this->account = $account;

        return $this;
    }

    public function getAbonne(): ?abonne
    {
        return $this->abonne;
    }

    public function setAbonne(abonne $abonne): self
    {
        $this->abonne = $abonne;

        return $this;
    }
}
