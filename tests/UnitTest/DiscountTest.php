<?php
/**
 * Created by PhpStorm.
 * User: ronsard
 * Date: 19/02/20
 * Time: 15:24
 */

namespace App\Tests\UnitTest;

use App\Entity\Product;
use App\Entity\Rules;
use App\Service\Discount;
use PHPUnit\Framework\TestCase;
use Symfony\Component\ExpressionLanguage\ExpressionLanguage;


class DiscountTest extends TestCase
{
    public function testChangeProductPrice()
    {
        $product = new Product();
        $rule    = new Rules();

        $product->setPrice('8');
        $product->setType('ménage');
        $product->setName('Ajax');

        $rule->setDiscountPercent(30);
        $rule->setRuleExpression('product.type=\'ménage\' and product.price > 5');

    }
}
