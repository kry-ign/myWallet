<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private UserPasswordEncoderInterface $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager): void
    {
        foreach ($this->getData() as $item) {
            $user = new User();
            $user->setUsername($item['userName']);
            $user->setRoles($item['roles']);
            $user->setEmail($item['email']);
            $user->setPassword($this->passwordEncoder->encodePassword($user, $item['password']));
            $manager->persist($user);
        }
        $manager->flush();
    }

    private function getData(): array
    {
        return [
            [
                'userName' => 'krystian',
                'password' => 'test1',
                'email' => 'krystian@o2.pl',
                'roles' => ['ROLE_USER'],
            ],
            [
                'userName' => 'adam',
                'password' => 'test2',
                'email' => 'adddn@o2.pl',
                'roles' => ['ROLE_USER'],
            ],
            [
                'userName' => 'admin',
                'password' => 'admin',
                'email' => 'admin@o2.pl',
                'roles' => ['ROLE_ADMIN', 'ROLE_USER'],
            ],
            [
                'userName' => 'janek',
                'password' => 'test3',
                'email' => 'janek@o2.pl',
                'roles' => ['ROLE_USER'],
            ],
        ];
    }
}
