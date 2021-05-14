<?php

namespace App\Entity;

use App\Entity\commonMixins\DateMixins;
use App\Repository\FamilyFoodRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=FamilyFoodRepository::class)
 */
class FamilyFood
{
    use DateMixins;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"get_all_food","get_one_food"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     * @Groups({"get_all_food","get_one_food"})
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=Food::class, mappedBy="familyfood")
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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

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
            $food->setFamilyfood($this);
        }

        return $this;
    }

    public function removeFood(Food $food): self
    {
        if ($this->food->removeElement($food)) {
            // set the owning side to null (unless already changed)
            if ($food->getFamilyfood() === $this) {
                $food->setFamilyfood(null);
            }
        }

        return $this;
    }
}
