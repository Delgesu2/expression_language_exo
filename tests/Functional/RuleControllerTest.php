<?php

namespace App\Tests\Functional;

use App\Controller\RuleController;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Class RuleControllerTest
 *
 * @package App\Tests\Functional
 */
class RuleControllerTest extends WebTestCase
{
    public function testRules()
    {
        $client = static::createClient();

        $client->request('GET','/rule/list');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());

    }

    public function testAddRule()
    {
        $client = static::createClient();

        $crawler = $client->request('GET','/rule/create');

        $form = $crawler->filter("form[name=rule]")->form([
            'rule[rule_expression]' => 'product.type = \'bricolage\' and product.price > 50',
            'rule[discount_percent]'=> '25'
        ]);

        $client->submit($form);
        $this->assertEquals(302, $client->getResponse()->getStatusCode());
        $client->followRedirects();
    }
}
