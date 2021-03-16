<?php

declare(strict_types=1);

namespace App\Handler\Product;

use App\Command\Product\EditProductCommand;
use Doctrine\ORM\EntityManagerInterface;

class EditProductHandler
{
    private EntityManagerInterface $objectManager;

    public function __construct(EntityManagerInterface $objectManager)
    {
        $this->objectManager = $objectManager;
    }

    public function handle(EditProductCommand $command): void
    {
        if ($command->getBudget()->getLeftValue() >= $command->getPrice()) {
            $product = $command->getProduct()
                ->setProductName($command->getProductName())
                ->setPrice($command->getPrice())
                ->setCategory($command->getCategory());

            $this->objectManager->persist($product);
            $this->objectManager->flush();
        }
    }
}
