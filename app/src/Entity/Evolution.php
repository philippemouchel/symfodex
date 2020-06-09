<?php

namespace App\Entity;

use App\Repository\EvolutionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EvolutionRepository::class)
 */
class Evolution
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity=Pokemon::class, mappedBy="evolution")
     */
    private $pokemon;

    /**
     * @ORM\OneToMany(targetEntity=Pokemon::class, mappedBy="evolvesFrom")
     */
    private $evolvesTo;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $evolTrigger;

    /**
     * @ORM\ManyToOne(targetEntity=EvolutionChain::class, inversedBy="evolution")
     * @ORM\JoinColumn(nullable=false)
     */
    private $evolutionChain;

    public function __construct()
    {
        $this->pokemon = new ArrayCollection();
        $this->evolvesTo = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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
            $pokemon->setEvolution($this);
        }

        return $this;
    }

    public function removePokemon(Pokemon $pokemon): self
    {
        if ($this->pokemon->contains($pokemon)) {
            $this->pokemon->removeElement($pokemon);
            // set the owning side to null (unless already changed)
            if ($pokemon->getEvolution() === $this) {
                $pokemon->setEvolution(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Pokemon[]
     */
    public function getEvolvesTo(): Collection
    {
        return $this->evolvesTo;
    }

    public function addEvolvesTo(Pokemon $evolvesTo): self
    {
        if (!$this->evolvesTo->contains($evolvesTo)) {
            $this->evolvesTo[] = $evolvesTo;
            $evolvesTo->setEvolvesFrom($this);
        }

        return $this;
    }

    public function removeEvolvesTo(Pokemon $evolvesTo): self
    {
        if ($this->evolvesTo->contains($evolvesTo)) {
            $this->evolvesTo->removeElement($evolvesTo);
            // set the owning side to null (unless already changed)
            if ($evolvesTo->getEvolvesFrom() === $this) {
                $evolvesTo->setEvolvesFrom(null);
            }
        }

        return $this;
    }

    public function getEvolTrigger(): ?string
    {
        return $this->evolTrigger;
    }

    public function setEvolTrigger(string $evolTrigger): self
    {
        $this->evolTrigger = $evolTrigger;

        return $this;
    }

    public function getEvolutionChain(): ?EvolutionChain
    {
        return $this->evolutionChain;
    }

    public function setEvolutionChain(?EvolutionChain $evolutionChain): self
    {
        $this->evolutionChain = $evolutionChain;

        return $this;
    }
}
