<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\UuidInterface;
use Ramsey\Uuid\Uuid;

/**
 * Class Rules
 * @package App\Entity
 *
 * @ORM\Entity
 * @ORM\Table(name="rules")
 */
class Rules
{
    /**
     * @ORM\Id
     * @ORM\Column(type="uuid", unique=true)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class="Ramsey\Uuid\Doctrine\UuidGenerator")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $rule_expression;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $discount_percent;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getRuleExpression()
    {
        return $this->rule_expression;
    }

    /**
     * @param mixed $rule_expression
     */
    public function setRuleExpression($rule_expression): void
    {
        $this->rule_expression = $rule_expression;
    }

    /**
     * @return mixed
     */
    public function getDiscountPercent()
    {
        return $this->discount_percent;
    }

    /**
     * @param mixed $discount_percent
     */
    public function setDiscountPercent($discount_percent): void
    {
        $this->discount_percent = $discount_percent;
    }


}