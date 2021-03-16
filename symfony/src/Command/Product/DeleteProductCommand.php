<?php

declare(strict_types=1);

namespace App\Command\Product;

use App\Entity\Product;

class DeleteProductCommand extends AbstractProductCommand
{
    private Product $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function getProduct(): Product
    {
        return $this->product;
    }
}
