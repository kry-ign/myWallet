<?php

declare(strict_types=1);

namespace App\Command\Budget;

use App\Entity\User;

class AbstractBudgetCommand implements BudgetCommandInterface
{
    private int $value = 0;
    private \DateTime $month;
    private User $user;

    public function getValue(): ?int
    {
        return $this->value;
    }

    public function setValue(int $budgetValue): self
    {
        $this->value = $budgetValue;

        return $this;
    }

    public function getMonth(): ?\DateTime
    {
        return $this->month;
    }

    public function setMonth(\DateTime $month): self
    {
        $this->month = $month;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
