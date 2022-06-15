<?php

namespace App\Entity;

use App\Repository\ProduitRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProduitRepository::class)]
class Produit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $libelle;

    #[ORM\Column(type: 'integer')]
    private $stock;

    #[ORM\OneToMany(mappedBy: 'Produit', targetEntity: Entree::class, orphanRemoval: true)]
    private $entrees;

    #[ORM\OneToMany(mappedBy: 'Produit', targetEntity: Sortie::class, orphanRemoval: true)]
    private $yes;

    #[ORM\OneToMany(mappedBy: 'Produit', targetEntity: User::class)]
    private $Produit;

    #[ORM\OneToMany(mappedBy: 'Produit', targetEntity: Categorie::class)]
    private $categories;

    public function __construct()
    {
        $this->entrees = new ArrayCollection();
        $this->yes = new ArrayCollection();
        $this->Produit = new ArrayCollection();
        $this->categories = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getStock(): ?int
    {
        return $this->stock;
    }

    public function setStock(int $stock): self
    {
        $this->stock = $stock;

        return $this;
    }

    /**
     * @return Collection<int, Entree>
     */
    public function getEntrees(): Collection
    {
        return $this->entrees;
    }

    public function addEntree(Entree $entree): self
    {
        if (!$this->entrees->contains($entree)) {
            $this->entrees[] = $entree;
            $entree->setProduit($this);
        }

        return $this;
    }

    public function removeEntree(Entree $entree): self
    {
        if ($this->entrees->removeElement($entree)) {
            // set the owning side to null (unless already changed)
            if ($entree->getProduit() === $this) {
                $entree->setProduit(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Sortie>
     */
    public function getYes(): Collection
    {
        return $this->yes;
    }

    public function addYe(Sortie $ye): self
    {
        if (!$this->yes->contains($ye)) {
            $this->yes[] = $ye;
            $ye->setProduit($this);
        }

        return $this;
    }

    public function removeYe(Sortie $ye): self
    {
        if ($this->yes->removeElement($ye)) {
            // set the owning side to null (unless already changed)
            if ($ye->getProduit() === $this) {
                $ye->setProduit(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getProduit(): Collection
    {
        return $this->Produit;
    }

    public function addProduit(User $produit): self
    {
        if (!$this->Produit->contains($produit)) {
            $this->Produit[] = $produit;
            $produit->setManyToOne($this);
        }

        return $this;
    }

    public function removeProduit(User $produit): self
    {
        if ($this->Produit->removeElement($produit)) {
            // set the owning side to null (unless already changed)
            if ($produit->getManyToOne() === $this) {
                $produit->setManyToOne(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Categorie>
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(Categorie $category): self
    {
        if (!$this->categories->contains($category)) {
            $this->categories[] = $category;
            $category->setProduit($this);
        }

        return $this;
    }

    public function removeCategory(Categorie $category): self
    {
        if ($this->categories->removeElement($category)) {
            // set the owning side to null (unless already changed)
            if ($category->getProduit() === $this) {
                $category->setProduit(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this-> libelle;
    }
}
