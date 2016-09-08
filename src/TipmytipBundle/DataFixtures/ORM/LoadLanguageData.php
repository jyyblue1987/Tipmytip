<?php 

// src/TipmytipBundle/DataFixtures/ORM/LoadLanguageData.php

namespace TipmytipBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use TipmytipBundle\Entity\Language;

class LoadLanguageData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $language1 = new Language();
        $language1->setName('English');
        
        $language2 = new Language();
        $language2->setName('French');
        
        $language3 = new Language();
        $language3->setName('Dutch');
        
        $manager->persist($language1);
        $manager->persist($language2);
        $manager->persist($language3);

        $manager->flush();
        
        $this->addReference('language1', $language1);
        $this->addReference('language2', $language2);
        $this->addReference('language3', $language3);

    }
    
    public function getOrder()
    {
    	return 3;
    }
}