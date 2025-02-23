<?php

namespace Pportelette\PageableBundle\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Tools\Pagination\Paginator as DoctrinePaginator;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Common\Collections\Criteria;
use Pportelette\PageableBundle\Model\Pageable;


abstract class AbstractRepository extends ServiceEntityRepository
{
    protected static $nbPerPage = 30;
    protected $_em = null;

    protected function __construct(ManagerRegistry $registry, string $entityClass)
    {
        parent::__construct($registry, $entityClass);
        $this->_em = $this->getEntityManager();
    }

    public static function setNbPerPage(int $nb) {
        self::$nbPerPage = $nb;
    }

    protected function getPage(QueryBuilder $qb, int $page, ?int $limit = null) {
        if(!$limit) {
            $limit = self::$nbPerPage;
        }
        $firstResult = ($page -1) * $limit;

        $criteria = Criteria::create()
        ->setFirstResult($firstResult)
        ->setMaxResults($limit);
        $qb->addCriteria($criteria);

        $doctrinePaginator = new DoctrinePaginator($qb, $fetchJoinCollection = false);
        return new Pageable($doctrinePaginator, $page, $limit);
    }

    public function add($entity, bool $flush = false): void
    {
        $this->_em->persist($entity);

        if ($flush) {
            $this->_em->flush();
        }
    }

    public function save($object, bool $flush = false):void {
        $this->add($object, $flush);
    }

    public function remove($entity, bool $flush = false): void
    {
        $this->_em->remove($entity);

        if ($flush) {
            $this->_em->flush();
        }
    }

    public function delete($object, bool $flush = false): void {
        $this->remove($object, $flush);
    }

}
