<?php

namespace App\Entity;

use App\Repository\BudgetRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BudgetRepository::class)
 */
class Budget
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    private $value;

    /**
     * @ORM\Column(type="date")
     */
    private $month;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="budgets")
     */
    private User $users;

    public function __construct(
//        float $value,
//        User $user,
//        \DateTime $dateTime
    )
    {
//        $this->value = $value;
//        $this->user = $user;
//        $this->month = $dateTime;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getValue(): ?float
    {
        return $this->value;
    }

    public function setValue(float $budgetValue): self
    {
        $this->value = $budgetValue;

        return $this;
    }

    public function getMonth(): ?\DateTimeInterface
    {
        return $this->month;
    }

    public function setMonth(\DateTimeInterface $month): self
    {
        $this->month = $month;

        return $this;
    }

    public function getUsers(): User
    {
        return $this->users;
    }

    public function setUsers(User $user): self
    {
        $this->users = $user;

        return $this;
    }
}
