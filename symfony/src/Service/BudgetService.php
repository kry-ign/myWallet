<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Budget;
use App\Entity\User;
use App\Repository\BudgetRepository;
use App\Repository\ProductRepository;

class BudgetService
{
    protected BudgetRepository $budgetRepository;
    protected ProductRepository $productsRepository;

    public function __construct(
        BudgetRepository $budgetRepository,
        ProductRepository $productsRepository
    ) {
        $this->budgetRepository = $budgetRepository;
        $this->productsRepository = $productsRepository;
    }

    public function getProducts(Budget $budget): array
    {
        return $this->productsRepository->findBy([
           'budget' => $budget,
        ]);
    }

    public function findAllByUser(User $user): array
    {
        return $this->budgetRepository->findAllByUser($user);
    }
}
