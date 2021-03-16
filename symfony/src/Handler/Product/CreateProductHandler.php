<?php

declare(strict_types=1);

namespace App\Handler\Product;

use App\Command\Product\CreateProductCommand;
use App\Factory\ProductFactory;
use Doctrine\ORM\EntityManagerInterface;

class CreateProductHandler
{
    private EntityManagerInterface $objectManager;

    public function __construct(EntityManagerInterface $objectManager)
    {
        $this->objectManager = $objectManager;
    }

    public function handle(CreateProductCommand $command): void
    {
        if ($command->getBudget()->getLeftValue() >= $command->getPrice()) {
            $product = ProductFactory::create(
            $command->getProductName(),
            $command->getCategory(),
            $command->getPrice(),
            $command->getBudget()
        );
            $this->objectManager->persist($product);
            $this->objectManager->flush();
        }
    }
}
