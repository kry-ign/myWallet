<?php

declare(strict_types=1);

namespace App\Tests\Unit\Entity;

use App\Entity\Budget;
use App\Entity\User;
use Faker\Factory;
use PHPUnit\Framework\TestCase;

class BudgetTest extends TestCase
{
    /**
     * @test
     * @dataProvider valuesProvider
     */
    public function itCanBeCreated(
        int $value,
        \DateTime $month,
        User $user
    ): void {
        $budget = new Budget(
            $value,
            $month,
            $user
        );

        $this->assertEquals($value, $budget->getValue());
        $this->assertEquals($month, $budget->getMonth());
        $this->assertEquals($user, $budget->getUser());
    }

    public function valuesProvider(): array
    {
        $faker = Factory::create();

        return [
            [
                $faker->randomNumber(),
                $faker->dateTime(),
                $this->createMock(User::class),
            ],
            [
                $faker->randomNumber(),
                $faker->dateTime(),
                $this->createMock(User::class),
            ],
            [
                $faker->randomNumber(),
                $faker->dateTime(),
                $this->createMock(User::class),
            ],
        ];
    }
}
