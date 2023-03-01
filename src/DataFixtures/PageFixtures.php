<?php

namespace App\DataFixtures;

use App\Entity\Page;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class PageFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $page = new Page();
        $page->setName('Page 1');
        $page->setContent('<p>Page 1</p>');
        $page->setMetaDescription('Meta Description');
        $page->setMetaTitle('Meta Title');
        $page->setUrl('page-1');
        $page->setStatus(1);

        $manager->persist($page);
        $manager->flush();
    }
}
