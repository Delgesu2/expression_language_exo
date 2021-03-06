<?php

namespace App\Repository;

use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * Class ProductRepository
 *
 * @package App\Repository
 *
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository
{
    /**
     * ProductRepository constructor.
     *
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    /**
     * Get product only if price is reduced
     *
     * @return mixed
     */
    public function getDiscountPrices()
    {
        return $this->createQueryBuilder('t')
            ->where('t.discounted_price' != NULL)
            ->getQuery()
            ->getResult()
            ;
    }

    /**
     * @param Product $product
     */
    public function save(Product $product)
    {
        $this->_em->persist($product);
        $this->_em->flush();
    }

}