<?php

namespace Pportelette\PageableBundle\Model;

use Doctrine\ORM\Tools\Pagination\Paginator;

class Pageable {
  public $page;
  public $total;
  public $results;
  public $nbPerPage;

  public function __construct(Paginator $paginator, int $page, int $nbPerPage) {
    $this->page = $page;
    $this->total = $paginator->count();
    $this->results = $paginator->getIterator()->getArrayCopy();
    $this->nbPerPage = $nbPerPage;
  }
}