<?php

namespace App\Model\Response;

class PaginatorResponse
{
    public function __construct(private array $data = [], private array $meta = [])
    {
    }

    public function getData(): array
    {
        return $this->data;
    }

    public function setData(array $data): PaginatorResponse
    {
        $this->data = $data;

        return $this;
    }

    public function getMeta(): array
    {
        return $this->meta;
    }

    public function setMeta(
        int $resultCount,
        string $totalPages
    ): PaginatorResponse
    {
        $this->meta = [
            'result_count' => $resultCount,
            'total_pages' => $totalPages,
        ];

        return $this;
    }
}