<?php

declare(strict_types=1);

namespace App\Tests\Unit\Entity;

use App\Entity\Category;
use Faker\Factory;
use PHPUnit\Framework\TestCase;

class CategoryTest extends TestCase
{
    /**
     * @test
     * @dataProvider valuesProvider
     */
    public function itCanBeCreated(
        string $name,
        ?string $description
    ): void {
        $category = new Category(
            $name,
            $description
        );

        $this->assertEquals($name, $category->getName());
        $this->assertEquals($description, $category->getDescription());
    }

    public function valuesProvider(): array
    {
        $faker = Factory::create();

        return [
            [
                $faker->name(),
                $faker->word(),
            ],
            [
                $faker->name(),
                null,
            ],
        ];
    }
}
