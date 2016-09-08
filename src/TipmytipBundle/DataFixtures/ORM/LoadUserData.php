<?php 

// src/TipmytipBundle/DataFixtures/ORM/LoadUserData.php

namespace TipmytipBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use TipmytipBundle\Entity\User;

class LoadUserData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $user1 = new User();
        $user1->setUsername('violaine@tipmytip.com');
        $user1->setPassword('000000');
        $user1->setFirstName('Violaine');
        $user1->setLastName('Baillon');
        $user1->setBirthdate('12/03/1988');
        $user1->setGender('female');
        $user1->setNationality('French');
        $user1->setCountry('France');
        $user1->setAdminAccount(false);
        $user1->setIsActive(true);
        
        $user2 = new User();
        $user2->setUsername('aurelien@tipmytip.com');
        $user2->setPassword('000000');
        $user2->setFirstName('Aurélien');
        $user2->setLastName('Baillon');
        $user2->setBirthdate('12/03/1980');
        $user2->setGender('male');
        $user2->setNationality('French');
        $user2->setCountry('France');
        $user2->setAdminAccount(false);
        $user2->setIsActive(true);
        
        $manager->persist($user1);
        $manager->persist($user2);

        $manager->flush();
		
        $this->addReference('user1', $user1);
        $this->addReference('user2', $user2);
    }
    
    public function getOrder()
    {
    	return 1;
    }
}