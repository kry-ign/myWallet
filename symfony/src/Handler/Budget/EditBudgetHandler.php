<?php

declare(strict_types=1);

namespace App\Handler\Budget;

use App\Command\Budget\EditBudgetCommand;
use Doctrine\ORM\EntityManagerInterface;

class EditBudgetHandler
{
    private EntityManagerInterface $objectManager;

    public function __construct(EntityManagerInterface $objectManager)
    {
        $this->objectManager = $objectManager;
    }

    public function handle(EditBudgetCommand $command): void
    {
        $budget = $command->getBudget()
           ->setValue($command->getValue())
           ->setMonth($command->getMonth())
           ->setUser($command->getUser())
       ;

        $this->objectManager->persist($budget);
        $this->objectManager->flush();
    }
}
