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
    protected function __construct(ManagerRegistry $registry, string $entityClass)
    {
        parent::__construct($registry, $entityClass);
    }

    protected function getPage(QueryBuilder $qb, int $page, int $limit = 30) {
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
