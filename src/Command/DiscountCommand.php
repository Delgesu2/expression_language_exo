<?php

namespace App\Command;

use App\Service\Discount;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class DiscountCommand extends Command
{
    /**
     * @var Discount
     */
    private $discount;

    protected static $defaultName = 'app:start-discount';

    /**
     * DiscountCommand constructor.
     * @param Discount $discount
     */
    public function __construct(Discount $discount)
    {
        parent::__construct();
        $this->discount = $discount;
    }

    protected function configure()
    {
        $this

            // command name (after "bin/console")
            ->setName('app:start-discount')

           // shown while running "php bin/console list"
            ->$this->setDescription('Apply discount on articles')

           // full description when running the command with "--help" option
            ->$this->setHelp('Cette commande applique toutes les expressions en BDD à la liste des produits disponibles.')

            ;
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     *
     * @return int|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->discount->changeProductPrice();

    }
}