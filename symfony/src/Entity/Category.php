<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
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
    private int $id;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private string $name;

    /**
     * @ORM\Column(type="string", length=40, nullable=true)
     */
    private ?string $description;

    /**
     * @ORM\OneToMany(targetEntity=Product::class, mappedBy="category", cascade={"persist", "remove"})
     */
    private $products;

    public function __construct(
        string $name,
        ?string $description
    ) {
        $this->name = $name;
        $this->description = $description;
        $this->products = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getProducts(): ArrayCollection
    {
        return $this->products;
    }

    public function setProducts(ArrayCollection $products): self
    {
        $this->products = $products;

        return $this;
    }

    public function addProduct(Product $product): self
    {
        $this->products[] = $product;

        return $this;
    }
}
