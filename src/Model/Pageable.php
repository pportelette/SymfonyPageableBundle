<?php

namespace Pportelette\PageableBundle\Model;

use Doctrine\ORM\Tools\Pagination\Paginator;

class Pageable {
  public ?int $page = null;
  public ?int $total = null;
  public ?array $items = null;
  public ?int $nbPerPage = null;
  public ?int $nbPages = null;

  public function __construct(Paginator $paginator, int $page, int $nbPerPage) {
    $this->page = $page;
    $this->total = $paginator->count();
    $this->items = $paginator->getIterator()->getArrayCopy();
    $this->nbPerPage = $nbPerPage;
    $this->nbPages = ceil($this->total / $this->nbPerPage);
  }
}