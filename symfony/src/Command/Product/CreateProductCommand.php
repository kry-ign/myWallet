<?php

declare(strict_types=1);

namespace App\Command\Product;

use App\Entity\Budget;

class CreateProductCommand extends AbstractProductCommand
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
