<?php

declare(strict_types=1);

namespace App\Handler\Budget;

use App\Command\Budget\DeleteBudgetCommand;
use Doctrine\ORM\EntityManagerInterface;

class DeleteBudgetHandler
{
    private EntityManagerInterface $objectManager;

    public function __construct(EntityManagerInterface $objectManager)
    {
        $this->objectManager = $objectManager;
    }

    public function handle(DeleteBudgetCommand $command): void
    {
        $this->objectManager->remove($command->getBudget());
        $this->objectManager->flush();
    }
}
