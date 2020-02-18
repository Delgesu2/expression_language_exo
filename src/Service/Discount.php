<?php

namespace App\Service;

use Symfony\Component\ExpressionLanguage\ExpressionLanguage;
use App\Entity\Product;
use App\Entity\Rules;

/**
 * Class Discount
 *
 * @package App\Service
 */
class Discount
{
    /**
     * @var ExpressionLanguage
     */
    private $expressionlanguage;

    /**
     * @var Rules
     */
    private $rules;

    /**
     * @var Product
     */
    private $product;

    /**
     * Discount constructor.
     * @param ExpressionLanguage $expressionlanguage
     * @param Rules $rules
     * @param Product $product
     */
    public function __construct(
        ExpressionLanguage $expressionlanguage,
        Rules              $rules,
        Product            $product
    )
    {
        $this->expressionlanguage = $expressionlanguage;
        $this->rules      = $rules;
        $this->product    = $product;
    }

//    public function __invoke()
//    {
//        $expression = $this->rules->getRuleExpression();
//        $percent = $this->rules->getDiscountPercent();
//        $price = $this->product->getPrice();
//
//        foreach ($this->product as $item){
//            $this->expressionlanguage->evaluate($expression, $percent*$price/100 => $this->product->setPrice())
//
//        }
//
//    }

}