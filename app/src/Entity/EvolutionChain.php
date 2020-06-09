<?php

namespace App\Entity;

use App\Repository\EvolutionChainRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EvolutionChainRepository::class)
 */
class EvolutionChain
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $familyName;

    /**
     * @ORM\OneToMany(targetEntity=Pokemon::class, mappedBy="evolutionChain")
     */
    private $pokemon;

    /**
     * @ORM\OneToMany(targetEntity=Evolution::class, mappedBy="evolutionChain", orphanRemoval=true)
     */
    private $evolution;

    public function __construct()
    {
        $this->pokemon = new ArrayCollection();
        $this->evolution = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFamilyName(): ?string
    {
        return $this->familyName;
    }

    public function setFamilyName(string $familyName): self
    {
        $this->familyName = $familyName;

        return $this;
    }

    /**
     * @return Collection|Pokemon[]
     */
    public function getPokemon(): Collection
    {
        return $this->pokemon;
    }

    public function addPokemon(Pokemon $pokemon): self
    {
        if (!$this->pokemon->contains($pokemon)) {
            $this->pokemon[] = $pokemon;
            $pokemon->setEvolutionChain($this);
        }

        return $this;
    }

    public function removePokemon(Pokemon $pokemon): self
    {
        if ($this->pokemon->contains($pokemon)) {
            $this->pokemon->removeElement($pokemon);
            // set the owning side to null (unless already changed)
            if ($pokemon->getEvolutionChain() === $this) {
                $pokemon->setEvolutionChain(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Evolution[]
     */
    public function getEvolution(): Collection
    {
        return $this->evolution;
    }

    public function addEvolution(Evolution $evolution): self
    {
        if (!$this->evolution->contains($evolution)) {
            $this->evolution[] = $evolution;
            $evolution->setEvolutionChain($this);
        }

        return $this;
    }

    public function removeEvolution(Evolution $evolution): self
    {
        if ($this->evolution->contains($evolution)) {
            $this->evolution->removeElement($evolution);
            // set the owning side to null (unless already changed)
            if ($evolution->getEvolutionChain() === $this) {
                $evolution->setEvolutionChain(null);
            }
        }

        return $this;
    }
}
