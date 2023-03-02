<?php

namespace App\Tests\Services\Admin;

use App\Entity\Page;
use App\Model\Response\PaginatorResponse;
use App\Repository\PageRepository;
use App\Services\Admin\PageService;
use App\Tests\AbstractTestCase;
use App\Utils\Paginator;

class PageServiceTest extends AbstractTestCase
{
    private PageRepository $pageRepository;

    protected function setUp(): void
    {
        parent::setUp();

        $this->pageRepository = $this->createMock(PageRepository::class);
    }

    public function testGetPage()
    {
        $paginator = $this->createMock(Paginator::class);

        $this->setPrivateProperty(Paginator::class, $paginator, 'resultCount', 1);
        $this->setPrivateProperty(Paginator::class, $paginator, 'totalPages', 1);
        $this->setPrivateProperty(Paginator::class, $paginator, 'data', [(array)$this->getEntity()]);

        $paginator->expects($this->once())
            ->method('getResultCount')
            ->willReturn(1);
        $paginator->expects($this->once())
            ->method('getTotalPages')
            ->willReturn(1);
        $paginator->expects($this->once())
            ->method('getData')
            ->willReturn([(array)$this->getEntity()]);

        $this->pageRepository->expects($this->once())
            ->method('getPage')
            ->with(1)
            ->willReturn($paginator);

        $service = (new PageService($this->pageRepository))->getPage(1);

        $expected = (new PaginatorResponse())
            ->setMeta(1,1)
            ->setData([(array)$this->getEntity()]);

        $this->assertEquals($expected, $service);
    }

    private function getEntity(): Page
    {
        $page = new Page();
        $this->setEntityId($page, 1);
        $page->setName('Page 1');
        $page->setContent('<p>Page 1</p>');
        $page->setMetaDescription('Meta Description');
        $page->setMetaTitle('Meta Title');
        $page->setUrl('page-1');
        $page->setStatus(1);

        return $page;
    }
}
