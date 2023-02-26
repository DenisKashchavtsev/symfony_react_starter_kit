<?php

namespace App\Services;

use App\Entity\Page;
use App\Model\Request\PageRequest;
use App\Repository\PageRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;

final readonly class PageService
{
    public function __construct(private PageRepository $pageRepository)
    {
    }

    public function getPage(int $page): Paginator
    {
        return $this->pageRepository->getPage($page);
    }

    public function getOne(int $id): Page
    {
        return $this->pageRepository->find($id);
    }

    public function create(PageRequest $request): Page
    {
        $entity = new Page();

        $this->pageRepository->save(
            $this->filler($entity, $request),
            true
        );

        return $entity;
    }

    public function update(int $id, PageRequest $request): Page
    {
        $entity = $this->getOne($id);

        $this->pageRepository->save(
            $this->filler($entity, $request),
            true
        );

        return $entity;
    }

    private function filler(Page $entity, PageRequest $request): Page
    {
        $entity->setName($request->getName())
            ->setContent($request->getContent())
            ->setUrl($request->getUrl())
            ->setMetaTitle($request->getMetaTitle())
            ->setMetaDescription($request->getMetaDescription())
            ->setStatus($request->isStatus());

        return $entity;
    }

    public function delete(int $id): void
    {
        $this->pageRepository->remove($this->getOne($id), true);
    }
}