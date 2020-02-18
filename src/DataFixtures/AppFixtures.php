<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class AppFixtures
 *
 * @package App\DataFixtures
 */
class AppFixtures extends Fixture
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $category = ['fruits', 'épicerie', 'bricolage', 'ménage', 'vestimentaire'];

        for ($i=0; $i<60; $i++) {

            $product = new Product();
            $product->setName('article n°'.$i);
            $product->setType($category[array_rand($category,1)]);

            if ($product->getType()==='fruits') {
                $product->setPrice(mt_rand(1, 6));
            }

            elseif ($product->getType()==='épicerie') {
                $product->setPrice(mt_rand(5, 25));
            }

            elseif ($product->getType()==='bricolage') {
                $product->setPrice(mt_rand(15, 100));
            }

            elseif ($product->getType()==='ménage') {
                $product->setPrice(mt_rand(5,25));
            }

            elseif ($product->getType()==='vestimentaire') {
                $product->setPrice(mt_rand(40, 130));
            }

            $manager->persist($product);

        }

        $manager->flush();
    }
}
