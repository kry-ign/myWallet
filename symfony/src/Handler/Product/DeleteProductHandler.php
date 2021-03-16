<?php

declare(strict_types=1);

namespace App\Handler\Product;

use App\Command\Product\DeleteProductCommand;
use Doctrine\ORM\EntityManagerInterface;

class DeleteProductHandler
{
    private EntityManagerInterface $objectManager;

    public function __construct(EntityManagerInterface $objectManager)
    {
        $this->objectManager = $objectManager;
    }

    public function handle(DeleteProductCommand $command): void
    {
        $this->objectManager->remove($command->getProduct());
        $this->objectManager->flush();
    }
}
