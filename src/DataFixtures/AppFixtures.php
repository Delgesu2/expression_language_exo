<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $category = ['fruits', 'épicerie', 'bricolage', 'ménage', 'vestimentaire'];

        for ($i=0; $i<60; $i++) {

            $product = new Product();
            $product->setName('article n°'.$i);
            $product->setPrice(mt_rand(3, 250));
            $product->setType($category[array_rand($category,1)]);
            $manager->persist($product);

        }

        $manager->flush();
    }
}
