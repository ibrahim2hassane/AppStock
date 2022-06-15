<?php

namespace App\Entity;

use App\Repository\EntreeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EntreeRepository::class)]
class Entree
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $Qtite;

    #[ORM\ManyToOne(targetEntity: Produit::class, inversedBy: 'entrees')]
    #[ORM\JoinColumn(nullable: false)]
    private $Produit;

    #[ORM\Column(type: 'string', length: 255)]
    private $prix;

    #[ORM\Column(type: 'date', nullable: true)]
    private $date;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQtite(): ?int
    {
        return $this->Qtite;
    }

    public function setQtite(?int $Qtite): self
    {
        $this->Qtite = $Qtite;

        return $this;
    }

    public function getProduit(): ?Produit
    {
        return $this->Produit;
    }

    public function setProduit(?Produit $Produit): self
    {
        $this->Produit = $Produit;

        return $this;
    }

    public function __toString()
    {
        return $this->libelle;
    }

    public function getPrix(): ?string
    {
        return $this->prix;
    }

    public function setPrix(string $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(?\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }
}
