<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategoryRepository::class)
 */
class Category
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $CategoryName;

    /**
     * @ORM\Column(type="string", length=40, nullable=true)
     */
    private $Description;

    /**
     * @ORM\OneToOne(targetEntity=Product::class, mappedBy="CategoryID", cascade={"persist", "remove"})
     */
    private $product;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCategoryName(): ?string
    {
        return $this->CategoryName;
    }

    public function setCategoryName(string $CategoryName): self
    {
        $this->CategoryName = $CategoryName;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(?string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): self
    {
        // unset the owning side of the relation if necessary
        if ($product === null && $this->product !== null) {
            $this->product->setCategoryID(null);
        }

        // set the owning side of the relation if necessary
        if ($product !== null && $product->getCategoryID() !== $this) {
            $product->setCategoryID($this);
        }

        $this->product = $product;

        return $this;
    }
}
