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
        foreach ($this->getData() as $item)
        {
            $category = new Category();
            $category->setCategoryName($item['categoryName']);
            $manager->persist($category);
        }
        $manager->flush();
    }

    private function getData(): array
    {
        return [
            [
                'categoryName' => 'entertainment'
            ],
            [
                'categoryName' => 'bills'
            ],
            [
                'categoryName' => 'shopping'
            ],
        ];
    }
}
