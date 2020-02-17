<?php

namespace App\Repository;

use App\Entity\Rules;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * Class RuleRepository
 * 
 * @package App\Repository
 * 
 * @method Rules|null find($id, $lockMode = null, $lockVersion = null)
 * @method Rules|null findOneBy(array $criteria, array $orderBy = null)
 * @method Rules[]    findAll()
 * @method Rules[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RuleRepository extends ServiceEntityRepository
{
    /**
     * RulesRepository constructor.
     *
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Rules::class);
    }

    /**
     * @param Rules $rule
     */
    public function save(Rules $rule)
    {
        $this->_em->persist($rule);
        $this->_em->flush();
    }
}