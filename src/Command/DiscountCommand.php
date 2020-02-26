<?php

namespace App\Command;

use App\Entity\Product;
use App\Entity\Rules;
use App\Repository\ProductRepository;
use App\Service\Mailer;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\ExpressionLanguage\ExpressionLanguage;
use Symfony\Component\Mailer\MailerInterface;

class DiscountCommand extends Command
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
     * @var ProductRepository
     */
    private $repository;

    /**
     * @var Mailer
     */
    private $mailer;

    /**
     * @var MailerInterface
     */
    private $mailerInterface;

    /**
     * @var ProductRepository
     */
    private $productRepository;


    protected static $defaultName = 'app:start-discount';

    /**
     * DiscountCommand constructor.
     *
     * @param ExpressionLanguage $expressionlanguage
     * @param Rules $rules
     * @param Product $product
     * @param ProductRepository $repository
     * @param Mailer $mailer
     * @param MailerInterface $mailerInterface
     * @param ProductRepository $productRepository
     */
    public function __construct(
        ExpressionLanguage $expressionlanguage,
        Rules              $rules,
        Product            $product,
        ProductRepository  $repository,
        Mailer             $mailer,
        MailerInterface    $mailerInterface,
        ProductRepository  $productRepository
    ) {
        parent::__construct();

        $this->expressionlanguage = $expressionlanguage;
        $this->rules              = $rules;
        $this->product            = $product;
        $this->repository         = $repository;
        $this->mailer             = $mailer;
        $this->mailerInterface    = $mailerInterface;
        $this->productRepository  = $productRepository;
    }


    protected function configure()
    {
        $this

            // command name (after "bin/console")
            ->setName('app:start-discount')

           // shown while running "php bin/console list"
            ->setDescription('Apply discount on articles')

           // full description when running the command with "--help" option
            ->setHelp('Cette commande applique toutes les expressions en BDD à la liste des produits disponibles.')
            ;
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return float|int
     *
     * @throws \Symfony\Component\Mailer\Exception\TransportExceptionInterface
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        foreach ($this->product as $item){

            $rules     = $this->rules->getRuleExpression();
            $price     = $this->product->getPrice();
            $new_price = ($this->rules->getDiscountPercent()*$price/100);

            foreach ($rules as $rule){
                $isLegit = $this->expressionlanguage->evaluate(
                    $rule,
                    $this->product);

                if($isLegit){
                    $this->product->setDiscountedPrice($new_price);
                    $this->repository->save($item);
                }
            }
        }

        $this->mailer->sendEmail($this->mailerInterface, $this->productRepository);

        return 0;

    }

}