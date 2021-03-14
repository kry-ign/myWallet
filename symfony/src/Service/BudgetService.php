<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\User;
use App\Repository\BudgetRepository;

class BudgetService
{
    protected BudgetRepository $budgetRepository;

    public function __construct(BudgetRepository $budgetRepository)
    {
        $this->budgetRepository = $budgetRepository;
    }

    public function findAllByUser(User $user): array
    {
       return $this->budgetRepository->findAllByUser($user);
    }

    public function create(User $user): array
    {
        return $this->budgetRepository->findAllByUser($user);
    }
}