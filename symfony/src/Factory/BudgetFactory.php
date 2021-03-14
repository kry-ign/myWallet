<?php

namespace App\Factory;

use App\Entity\Budget;
use App\Entity\User;

class BudgetFactory
{
    public static function create(
        int $value,
        User $user,
        \DateTime $dateTime
    ): Budget
    {
        $budget = new Budget();
        $budget->setValue($value);
        $budget->setUser($user);
        $budget->setMonth($dateTime);

        return $budget;
    }
}
