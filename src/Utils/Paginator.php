<?php

namespace App\Utils;

use Doctrine\ORM\Tools\Pagination\Paginator as OrmPaginator;

class Paginator
{
    private ?int $resultCount;
    private int $totalPages;
    private array $data;

    public function __construct($query)
    {
        $ormPaginator = new OrmPaginator($query, false);

        $this->resultCount = $ormPaginator->count();
        $this->totalPages = (int) ceil($ormPaginator->count() / $ormPaginator->getQuery()->getMaxResults());
        $this->data = $ormPaginator->getIterator()->getArrayCopy();
    }

    public function getResultCount(): ?int
    {
        return $this->resultCount;
    }

    public function getTotalPages(): int
    {
        return $this->totalPages;
    }

    public function getData(): array
    {
        return $this->data;
    }
}