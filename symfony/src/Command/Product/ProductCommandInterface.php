<?php

declare(strict_types=1);

namespace App\Command\Product;

use App\Entity\Budget;
use App\Entity\Category;

interface ProductCommandInterface
{
    public function getProductName(): string;

    public function setProductName(string $productName): self;

    public function getCategory(): Category;

    public function setCategory(Category $category): void;

    public function getPrice(): int;

    public function setPrice(int $price): self;

    public function getBudget(): Budget;

    public function setBudget(Budget $budget): self;
}
