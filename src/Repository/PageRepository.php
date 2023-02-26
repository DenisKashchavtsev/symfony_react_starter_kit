<?php

namespace App\Repository;

use App\Entity\Page;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Page>
 *
 * @method Page|null find($id, $lockMode = null, $lockVersion = null)
 * @method Page|null findOneBy(array $criteria, array $orderBy = null)
 * @method Page[]    findAll()
 * @method Page[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PageRepository extends ServiceEntityRepository
{
    const LIMIT = 25;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Page::class);
    }

    public function getPage($page = 1): Paginator
    {
        $query = $this->getEntityManager()
            ->createQueryBuilder()
            ->select('p')
            ->from(Page::class, 'p')
            ->orderBy('p.id')
            ->setMaxResults(self::LIMIT)
            ->setFirstResult($page === 1 ? 0 : $page * self::LIMIT + 1);

        return new Paginator($query, false);
    }

    public function save(Page $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Page $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
