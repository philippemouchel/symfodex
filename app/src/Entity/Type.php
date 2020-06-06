<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\Translatable\Translatable;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TypeRepository")
 */
class Type implements Translatable
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Gedmo\Translatable
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=128)
     * @Gedmo\Translatable
     * @Gedmo\Slug(fields={"name"})
     */
    private $slug;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Pokemon", mappedBy="type")
     */
    private $pokemon;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $color;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $bootstrapColor;

    /**
     * @Gedmo\Locale
     * Used locale to override Translation listener`s locale
     * this is not a mapped field of entity metadata, just a simple property
     */
    private $locale;

    public function __construct()
    {
        $this->pokemon = new ArrayCollection();
    }

    public function __toString() :?string
    {
        return $this->name;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

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
            $pokemon->addType($this);
        }

        return $this;
    }

    public function removePokemon(Pokemon $pokemon): self
    {
        if ($this->pokemon->contains($pokemon)) {
            $this->pokemon->removeElement($pokemon);
            $pokemon->removeType($this);
        }

        return $this;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(string $color): self
    {
        $this->color = $color;

        return $this;
    }


    public function getBackgroundProperty() {
        $colors = explode(',', $this->color);
        switch (count($colors)) {
            case 1:
                return 'background-color: ' . $colors[0] . ';';
            case 2:
                return 'background: linear-gradient(180deg, ' . $colors[0] . ' 50%, ' . $colors[1] . ' 50%); background-color: ' . $colors[0] . ';';
            default:
                return '';
        }
    }

    public function getBootstrapColor(): ?string
    {
        return $this->bootstrapColor;
    }

    public function setBootstrapColor(string $bootstrapColor): self
    {
        $this->bootstrapColor = $bootstrapColor;

        return $this;
    }

    public function getTranslatableLocale(): ?string
    {
        return $this->locale;
    }

    public function setTranslatableLocale($locale): self
    {
        $this->locale = $locale;

        return $this;
    }
}
