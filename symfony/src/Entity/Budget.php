<?php

namespace App\Entity;

use App\Repository\BudgetRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BudgetRepository::class)
 */
class Budget
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="integer")
     */
    private int $value;

    /**
     * @ORM\Column(type="date")
     */
    private \DateTime $month;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="budgets")
     */
    private User $user;

    /**
     * @ORM\OneToMany(targetEntity=Product::class, mappedBy="budget", cascade={"persist", "remove"})
     */
    private $products;

    public function __construct(
        int $value,
        \DateTime $month,
        User $user
    ) {
        $this->value = $value;
        $this->month = $month;
        $this->user = $user;
        $this->products = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getValue(): int
    {
        return $this->value;
    }

    public function setValue(int $budgetValue): self
    {
        $this->value = $budgetValue;

        return $this;
    }

    public function getMonth(): \DateTime
    {
        return $this->month;
    }

    public function setMonth(\DateTime $month): self
    {
        $this->month = $month;

        return $this;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getLeftValue(): int
    {
        $cost = 0;

        foreach ($this->products as $product) {
            $cost += $product->getPrice();
        }

        return $this->value - $cost;
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
