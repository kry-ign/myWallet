<?php

declare(strict_types=1);

namespace App\Command\Budget;

use App\Entity\Budget;

class EditBudgetCommand extends AbstractBudgetCommand
{
    private Budget $budget;

    public function __construct(Budget $budget)
    {
        $this->budget = $budget;
        $this->setValue($budget->getValue());
        $this->setUser($budget->getUser());
        $this->setMonth($budget->getMonth());
    }

    public function getBudget(): Budget
    {
        return $this->budget;
    }
}
