<?php

namespace App\DataFixtures;

use App\Entity\Wish;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class WishFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($o = 0;$o<150;$o++){

            $wish = new Wish();
            $wish->setTitle("Wish n° " . $o);
            if(($o < 25 || $o>112) && $o&1){
                //nb impair
                $wish->setAuthor('Doudou');
            }elseif($o>74){
                //nb pair
                $wish->setAuthor('Pablo Bar');
            }else{
                $wish->setAuthor('El padre');
            }

            $wish->setDescription('"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum');

            if($o%2 == 1){
                $wish->setIsPublished(true);
            }else{
                $wish->setIsPublished(false);
            }

            //gestion d'une date dans le passé en retirant n jours à la date du jours (n aléatoire)
            $n = mt_rand(0,678);
            $date = new \DateTime('now');
            $date->sub(new \DateInterval('P'.$n.'D'));
            $wish->setCreatedAt($date);

            $manager->persist($wish);
        }

        $manager->flush();
    }
}
