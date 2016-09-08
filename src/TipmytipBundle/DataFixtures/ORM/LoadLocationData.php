<?php 

// src/TipmytipBundle/DataFixtures/ORM/LoadLocationData.php

namespace TipmytipBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use TipmytipBundle\Entity\Location;

class LoadLocationData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $location1 = new Location();
        $location1->setLatitude('48.85341');
        $location1->setLongitude('2.3488');
        $location1->setName('Paris');
        $location1->setAvailable(1);
        
        $location2 = new Location();
        $location2->setLatitude('52.37403');
        $location2->setLongitude('4.88969');
        $location2->setName('Amsterdam');
        $location2->setAvailable(1);
        
        $location3 = new Location();
        $location3->setLatitude('51.9225');
        $location3->setLongitude('4.47917');
        $location3->setName('Rotterdam');
        $location3->setAvailable(1);
        
        $location4 = new Location();
        $location4->setLatitude('45.74846');
        $location4->setLongitude('4.84671');
        $location4->setName('Lyon');
        $location4->setAvailable(0);
        
        $location5 = new Location();
        $location5->setLatitude('47.38333');
        $location5->setLongitude('0.68333');
        $location5->setName('Tours');
        $location5->setAvailable(0);
        
        $manager->persist($location1);
        $manager->persist($location2);
        $manager->persist($location3);
        $manager->persist($location4);
        $manager->persist($location5);

        $manager->flush();
        

    }
    
    public function getOrder()
    {
    	return 2;
    }
}