<?php 

// src/TipmytipBundle/DataFixtures/ORM/LoadUserLanguageData.php

namespace TipmytipBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use TipmytipBundle\Entity\UserLanguage;

class LoadUserLanguageData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $userlanguage1 = new UserLanguage();
        $userlanguage1->setUser($this->getReference('user1'));
        $userlanguage1->setLanguage($this->getReference('language1'));
        
        $userlanguage2 = new UserLanguage();
        $userlanguage2->setUser($this->getReference('user1'));
        $userlanguage2->setLanguage($this->getReference('language2'));
        
        $userlanguage3 = new UserLanguage();
        $userlanguage3->setUser($this->getReference('user2'));
        $userlanguage3->setLanguage($this->getReference('language1'));
        
        $userlanguage4 = new UserLanguage();
        $userlanguage4->setUser($this->getReference('user2'));
        $userlanguage4->setLanguage($this->getReference('language2'));
        
        $userlanguage5 = new UserLanguage();
        $userlanguage5->setUser($this->getReference('user2'));
        $userlanguage5->setLanguage($this->getReference('language3'));
        
        $manager->persist($userlanguage1);
        $manager->persist($userlanguage2);
        $manager->persist($userlanguage3);
        $manager->persist($userlanguage4);
        $manager->persist($userlanguage5);

        $manager->flush();

    }
    
    public function getOrder()
    {
    	return 4;
    }
}