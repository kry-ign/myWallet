<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Factory\BudgetFactory;
use App\Repository\UserRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class BudgetFixtures extends Fixture implements DependentFixtureInterface
{
    private const DEFAULT_LOCALE = 'pl_PL';

    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create(self::DEFAULT_LOCALE);

        foreach ($this->getData() as $date) {
            $budget = BudgetFactory::create(
                $faker->numberBetween(1, 400000),
                new \DateTime($date),
                $this->userRepository->findOneBy([])
            );
            $manager->persist($budget);
        }
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
          UserFixtures::class,
        ];
    }

    private function getData(): array
    {
        return [
            '2020-01',
            '2020-02',
            '2020-03',
            '2020-04',
            '2020-05',
            '2020-06',
            '2020-07',
            '2020-08',
            '2020-09',
            '2020-10',
            '2020-11',
            '2020-12',
        ];
    }
}
