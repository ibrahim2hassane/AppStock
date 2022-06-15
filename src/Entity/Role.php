<?php

namespace App\Entity;

use App\Repository\RoleRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RoleRepository::class)]
class Role
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 200)]
    private $nom;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'roles')]
    private $ManyToOne;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getManyToOne(): ?User
    {
        return $this->ManyToOne;
    }

    public function setManyToOne(?User $ManyToOne): self
    {
        $this->ManyToOne = $ManyToOne;

        return $this;
    }
}
