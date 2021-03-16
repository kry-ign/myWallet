<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        foreach ($this->getData() as $item) {
            $category = new Category(
                $item['categoryName'],
                $item['description']
            );
            $manager->persist($category);
        }
        $manager->flush();
    }

    private function getData(): array
    {
        return [
            [
                'categoryName' => 'entertainment',
                'description' => 'simple description',
            ],
            [
                'categoryName' => 'bills',
                'description' => 'simple description',
            ],
            [
                'categoryName' => 'shopping',
                'description' => null,
            ],
        ];
    }
}
