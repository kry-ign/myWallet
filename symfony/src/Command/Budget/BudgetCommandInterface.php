<?php

declare(strict_types=1);

namespace App\Command\Budget;

use App\Entity\User;

interface BudgetCommandInterface
{
    public function getValue(): ?int;

    public function setValue(int $budgetValue): self;

    public function getMonth(): ?\DateTime;

    public function setMonth(\DateTime $month): self;

    public function getUser(): ?User;

    public function setUser(User $user): self;
}
