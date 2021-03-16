<?php

namespace App\Factory;

use App\Entity\Budget;
use App\Entity\Category;
use App\Entity\Product;

class ProductFactory
{
    public static function create(
        string $productName,
        Category $category,
        int $price,
        Budget $budget
    ): Product {
        return new Product(
            $productName,
            $category,
            $price,
            $budget
        );
    }
}
