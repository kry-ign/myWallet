<?php

declare(strict_types=1);

namespace App\Handler;

use App\Command\CreateBudgetCommand;
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

    public function handle(CreateBudgetCommand $budgetCreateCommand): void
   {
       $budget = BudgetFactory::create(
           $budgetCreateCommand->getValue(),
           $this->security->getUser(),
           $budgetCreateCommand->getMonth(),
       );
       $this->objectManager->persist($budget);
       $this->objectManager->flush();
   }
}
