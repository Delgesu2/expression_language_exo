<?php

namespace App\Tests\Functional;

use App\Controller\HomeController;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Class HomeControllerTest
 *
 * @package App\Tests\Functional
 */
class HomeControllerTest extends WebTestCase
{
    public function testHomePage()
    {
        $client = static::createClient();

        $client->request('GET','/');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}
