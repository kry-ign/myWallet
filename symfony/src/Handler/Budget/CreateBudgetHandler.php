<?php

declare(strict_types=1);

namespace App\Handler\Budget;

use App\Command\Budget\CreateBudgetCommand;
use App\Factory\BudgetFactory;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Security;

class CreateBudgetHandler
{
    private EntityManagerInterface $objectManager;
    private Security $security;

    public function __construct(EntityManagerInterface $objectManager, Security $security)
    {
        $this->objectManager = $objectManager;
        $this->security = $security;
    }

    public function handle(CreateBudgetCommand $command): void
    {
        $budget = BudgetFactory::create(
           $command->getValue(),
            $command->getMonth(),
            $this->security->getUser()
       );
        $this->objectManager->persist($budget);
        $this->objectManager->flush();
    }
}
