<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PictureRepository")
 */
class Picture
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Trick", inversedBy="pictures")
     */
    private $trick;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\User", inversedBy="picture", cascade={"persist", "remove"})
     */
    private $user;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    public function __construct()
    {
        $this->trick = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|Trick[]
     */
    public function getTrick(): Collection
    {
        return $this->trick;
    }

    public function addTrick(Trick $trick): self
    {
        if (!$this->trick->contains($trick)) {
            $this->trick[] = $trick;
        }

        return $this;
    }

    public function removeTrick(Trick $trick): self
    {
        if ($this->trick->contains($trick)) {
            $this->trick->removeElement($trick);
        }

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
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
}
