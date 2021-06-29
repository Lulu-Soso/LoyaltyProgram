<?php

namespace App\DataFixtures;

use App\Entity\Purchase;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class PurchaseFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        $purchase = new Purchase;
        $purchase->setUserName('alban');
        $purchase->setServiceName('dessin');
        $purchase->setPrice('150');
        $manager->persist($purchase);

        $purchase = new Purchase;
        $purchase->setUserName('alban');
        $purchase->setServiceName('tableau');
        $purchase->setPrice('250');
        $manager->persist($purchase);

        $purchase = new Purchase;
        $purchase->setUserName('jerome');
        $purchase->setServiceName('portrait');
        $purchase->setPrice('450');
        $manager->persist($purchase);
        
        $manager->flush();
    }
}
