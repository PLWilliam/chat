<?php

namespace App\DataFixtures;

use App\Entity\FriendRequestStatus;
use App\Entity\Friends;
use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordHasherInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }
    
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        for ($i=1; $i <= 20; $i++) { 
            $user = new User();
            $user->setEmail('m@'.$i);
            $hashedPassword = $this->passwordEncoder->hashPassword($user, $i);
            $user->setPassword($hashedPassword);
            $user->setName('m'.$i);

            $manager->persist($user);
        }

        $status = ['Waiting','Accepted','Denied'];

        foreach ($status as $key => $value) {
            $status = new FriendRequestStatus();
            $status->setStatus($value);
            $manager->persist($status);
        }
        
        $manager->flush();

    }
}
