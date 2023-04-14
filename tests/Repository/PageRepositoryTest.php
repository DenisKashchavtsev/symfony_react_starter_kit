<?php

namespace App\Tests\Repository;

use App\Entity\Page;
use App\Tests\AbstractRepositoryTest;
use App\Utils\Paginator;
use Doctrine\ORM\EntityRepository;

class PageRepositoryTest extends AbstractRepositoryTest
{
    private EntityRepository $pageRepository;

    public function testGetPage()
    {
        for ($i = 0; $i < 26; ++$i) {
            $page = $this->getEntity()->setName('Page ' . $i);

            $this->em->persist($page);
        }

        $this->em->flush();

        $repository = $this->pageRepository->getPage();

        $this->assertInstanceOf(Paginator::class, $repository);
        $this->assertEquals(26, $repository->getResultCount());
        $this->assertEquals(2, $repository->getTotalPages());
        $this->assertCount(25, $repository->getData());

        $repository = $this->pageRepository->getPage(2);

        $this->assertInstanceOf(Paginator::class, $repository);
        $this->assertEquals(26, $repository->getResultCount());
        $this->assertEquals(2, $repository->getTotalPages());
        $this->assertCount(1, $repository->getData());
    }

    private function getEntity(): Page
    {
        $page = new Page();
        $page->setName('Page 1');
        $page->setContent('<p>Page 1</p>');
        $page->setMetaDescription('Meta Description');
        $page->setMetaTitle('Meta Title');
        $page->setUrl('page-1');
        $page->setStatus(1);

        return $page;
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->pageRepository = $this->em->getRepository(Page::class);
    }
}
