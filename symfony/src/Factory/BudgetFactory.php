<?php

namespace App\Factory;

use App\Entity\Budget;
use App\Entity\User;

class BudgetFactory
{
    public static function create(
        int $value,
        \DateTime $month,
        User $user
    ): Budget {
        return new Budget(
            $value,
            $month,
            $user
        );
    }
}
