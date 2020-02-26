<?php

namespace App\Tests\Command;

use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Console\Tester\CommandTester;

class DiscountCommandTest extends KernelTestCase
{
    public function testExecute()
    {
        $kernel = static::createKernel();
        $application = new Application($kernel);

        $command = $application->find('app:start-discount');
        $commandTester = new CommandTester($command);
        $commandTester->execute([
            'rule_expression' => 'product.type = \'bricolage\' and product.price > 50',
            'discount_percent' => 40,
            'name' => 'Ajax',
            'type' => 'ménage',
            'price' => 8
        ]);

        $output = $commandTester->getDisplay();
        $this->assertContains('discount_price: 2.4', $output );

    }

}
