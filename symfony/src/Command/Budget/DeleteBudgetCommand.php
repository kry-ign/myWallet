<?php

declare(strict_types=1);

namespace App\Command\Budget;

use App\Entity\Budget;

class DeleteBudgetCommand extends AbstractBudgetCommand
{
    private Budget $budget;

    public function __construct(Budget $budget)
    {
        $this->budget = $budget;
    }

    public function getBudget(): Budget
    {
        return $this->budget;
    }
}
