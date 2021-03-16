<?php

declare(strict_types=1);

namespace App\Command\Product;

use App\Entity\Product;

class EditProductCommand extends AbstractProductCommand
{
    private Product $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
        $this->setCategory($product->getCategory());
        $this->setPrice($product->getPrice());
        $this->setProductName($product->getProductName());
    }

    public function getProduct(): Product
    {
        return $this->product;
    }
}
