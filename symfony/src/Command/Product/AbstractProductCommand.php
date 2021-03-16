<?php

declare(strict_types=1);

namespace App\Command\Product;

use App\Entity\Budget;
use App\Entity\Category;

class AbstractProductCommand implements ProductCommandInterface
{
    private string $productName;
    private Category $category;
    private int $price;
    private Budget $budget;

    public function getProductName(): string
    {
        return $this->productName;
    }

    public function setProductName(string $productName): self
    {
        $this->productName = $productName;

        return $this;
    }

    public function getCategory(): Category
    {
        return $this->category;
    }

    public function setCategory(Category $category): void
    {
        $this->category = $category;
    }

    public function getPrice(): int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getBudget(): Budget
    {
        return $this->budget;
    }

    public function setBudget(Budget $budget): self
    {
        $this->budget = $budget;

        return $this;
    }
}
