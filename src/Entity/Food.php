<?php

namespace App\Entity;

use App\Entity\commonMixins\DateMixins;
use App\Repository\FoodRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FoodRepository::class)
 */
class Food
{
    use DateMixins;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantity;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $expirationDate;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isOutOfDate;

    /**
     * @ORM\ManyToOne(targetEntity=FamilyFood::class, inversedBy="food")
     * @ORM\JoinColumn(nullable=false)
     */
    private $familyfood;

    /**
     * @ORM\ManyToOne(targetEntity=Preservation::class, inversedBy="food")
     * @ORM\JoinColumn(nullable=false)
     */
    private $preservation;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="food")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

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

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getExpirationDate(): ?\DateTimeInterface
    {
        return $this->expirationDate;
    }

    public function setExpirationDate(?\DateTimeInterface $expirationDate): self
    {
        $this->expirationDate = $expirationDate;

        return $this;
    }

    public function getIsOutOfDate(): ?bool
    {
        return $this->isOutOfDate;
    }

    public function setIsOutOfDate(bool $isOutOfDate): self
    {
        $this->isOutOfDate = $isOutOfDate;

        return $this;
    }

    public function getFamilyfood(): ?FamilyFood
    {
        return $this->familyfood;
    }

    public function setFamilyfood(?FamilyFood $familyfood): self
    {
        $this->familyfood = $familyfood;

        return $this;
    }

    public function getPreservation(): ?Preservation
    {
        return $this->preservation;
    }

    public function setPreservation(?Preservation $preservation): self
    {
        $this->preservation = $preservation;

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
}
