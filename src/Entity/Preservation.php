<?php

namespace App\Entity;

use App\Entity\commonMixins\DateMixins;
use App\Repository\PreservationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=PreservationRepository::class)
 */
class Preservation
{
    use DateMixins;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"get_all_food","get_one_food","get_all_preservation","get_one_preservation"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     * @Groups({"get_all_food","get_one_food","get_all_preservation","get_one_preservation"})
     */
    private $type;

    /**
     * @ORM\OneToMany(targetEntity=Food::class, mappedBy="preservation")
     */
    private $food;

    public function __construct()
    {
        $this->food = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection|Food[]
     */
    public function getFood(): Collection
    {
        return $this->food;
    }

    public function addFood(Food $food): self
    {
        if (!$this->food->contains($food)) {
            $this->food[] = $food;
            $food->setPreservation($this);
        }

        return $this;
    }

    public function removeFood(Food $food): self
    {
        if ($this->food->removeElement($food)) {
            // set the owning side to null (unless already changed)
            if ($food->getPreservation() === $this) {
                $food->setPreservation(null);
            }
        }

        return $this;
    }
}
