<?php

namespace App\Tests\Services\Admin;

use App\Entity\Page;
use App\Model\Request\PageRequest;
use App\Model\Response\PaginatorResponse;
use App\Repository\PageRepository;
use App\Services\Admin\PageService;
use App\Tests\AbstractTestCase;
use App\Utils\Paginator;

class PageServiceTest extends AbstractTestCase
{
    private PageRepository $pageRepository;

    public function testGetPage()
    {
        $paginator = $this->createMock(Paginator::class);

        $this->setPrivateProperty(Paginator::class, $paginator, 'resultCount', 1);

        $paginator->expects($this->once())
            ->method('getResultCount')
            ->willReturn(1);
        $paginator->expects($this->once())
            ->method('getTotalPages')
            ->willReturn(1);
        $paginator->expects($this->once())
            ->method('getData')
            ->willReturn([(array) $this->getEntity()]);

        $this->pageRepository->expects($this->once())
            ->method('getPage')
            ->with(1)
            ->willReturn($paginator);

        $service = (new PageService($this->pageRepository))->getPage(1);

        $expected = (new PaginatorResponse())
            ->setMeta(1, 1)
            ->setData([(array) $this->getEntity()]);

        $this->assertEquals($expected, $service);
    }

    private function getEntity(bool $setId = true): Page
    {
        $page = new Page();
        if ($setId) {
            $this->setEntityId($page, 1);
        }
        $page->setName('Page 1');
        $page->setContent('<p>Page 1</p>');
        $page->setMetaDescription('Meta Description');
        $page->setMetaTitle('Meta Title');
        $page->setUrl('page-1');
        $page->setStatus(1);

        return $page;
    }

    public function testGetOne()
    {
        $this->pageRepository->expects($this->once())
            ->method('find')
            ->with(1)
            ->willReturn($this->getEntity());

        $service = (new PageService($this->pageRepository))->getOne(1);

        $this->assertEquals($this->getEntity(), $service);
    }

    public function testCreate()
    {
        $this->pageRepository->expects($this->once())
            ->method('save')
            ->with($this->getEntity(false), true);

        $service = (new PageService($this->pageRepository))->create($this->getRequest());

        $this->assertEquals($this->getEntity(false), $service);
    }

    private function getRequest(): PageRequest
    {
        $pageRequest = new PageRequest();
        $pageRequest->setName('Page 1');
        $pageRequest->setContent('<p>Page 1</p>');
        $pageRequest->setMetaDescription('Meta Description');
        $pageRequest->setMetaTitle('Meta Title');
        $pageRequest->setUrl('page-1');
        $pageRequest->setStatus(1);

        return $pageRequest;
    }

    public function testUpdate()
    {
        $this->pageRepository->expects($this->once())
            ->method('find')
            ->with(1)
            ->willReturn($this->getEntity());

        $this->pageRepository->expects($this->once())
            ->method('save')
            ->with($this->getEntity(), true);

        $service = (new PageService($this->pageRepository))->update(1, $this->getRequest());

        $this->assertEquals($this->getEntity(), $service);
    }

    public function testDelete()
    {
        $this->pageRepository->expects($this->once())
            ->method('find')
            ->with(1)
            ->willReturn($this->getEntity());

        $this->pageRepository->expects($this->once())
            ->method('remove')
            ->with($this->getEntity(), true);

        (new PageService($this->pageRepository))->remove(1);
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->pageRepository = $this->createMock(PageRepository::class);
    }
}
