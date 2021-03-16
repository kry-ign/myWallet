<?php

declare(strict_types=1);

namespace App\Tests\Unit\Entity;

use App\Entity\Budget;
use App\Entity\Category;
use App\Entity\Product;
use Faker\Factory;
use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{
    /**
     * @test
     * @dataProvider valuesProvider
     */
    public function itCanBeCreated(
        string $productName,
        Category $category,
        int $price,
        Budget $budget
    ): void {
        $product = new Product(
            $productName,
            $category,
            $price,
            $budget,
        );

        $this->assertEquals($productName, $product->getProductName());
        $this->assertEquals($category, $product->getCategory());
        $this->assertEquals($price, $product->getPrice());
        $this->assertEquals($budget, $product->getBudget());
    }

    public function valuesProvider(): array
    {
        $faker = Factory::create();

        return [
            [
                $faker->name(),
                $this->createMock(Category::class),
                $faker->randomNumber(),
                $this->createMock(Budget::class),
            ],
        ];
    }
}
