<?php

namespace App\Tests\UnitTest;

use App\Entity\Product;
use App\Entity\Rules;
use App\Service\Discount;
use PHPUnit\Framework\TestCase;
use Symfony\Component\ExpressionLanguage\ExpressionLanguage;

/**
 * Class DiscountTest
 *
 * @package App\Tests\UnitTest
 */
class DiscountTest extends TestCase
{
    public function testChangeProductPrice()
    {
        $product  = new Product();
        $rule     = new Rules();
        $discount = new Discount();

        $product->setPrice('8');
        $product->setType('ménage');
        $product->setName('Ajax');

        $rule->setDiscountPercent(30);
        $rule->setRuleExpression('product.type=\'ménage\' and product.price > 5');

        $discount->changeProductPrice();

        $this->assertEquals(2.4, $product->getDiscountedPrice(),'L\'expression fonctionne');

    }
}
