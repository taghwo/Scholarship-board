<?php

namespace App\Repository;

use App\Repository\Data\LengthAwarePaginator;
use App\Repository\Data\MetaData;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Symfony\Component\HttpFoundation\Request;

abstract class BaseRepository extends ServiceEntityRepository
{
    public function paginate(int $limit = 20, string $sortDirection = 'DESC', string $orderByColumn = 'id'): LengthAwarePaginator
    {
        $page = $this->getCurrentPage();

        $query = $this->createQueryBuilder('p')
                      ->orderBy("p.{$orderByColumn}", $sortDirection)
                      ->setMaxResults($limit);

        $paginator = (new Paginator($query));
        $itemsCount = $this->getTotalItemsCount($paginator);
        $pageCount = ceil($itemsCount / $limit);

        $items = $paginator
             ->getQuery()
             ->setFirstResult($limit * ($page - 1))
             ->setMaxResults($limit)
             ->getResult();

        return new LengthAwarePaginator(
            data: $items,
            meta: new MetaData(
                page: $page,
                pageCount: $pageCount,
                itemCount: $itemsCount
            )
        );
    }

    private function getRequestParameters(): Request
    {
        return Request::createFromGlobals();
    }

    private function getCurrentPage(): int
    {
        $request = $this->getRequestParameters();

        return (int) $request->query->get('page', 1);
    }

    private function getTotalItemsCount(Paginator $paginator): int
    {
        return count($paginator);
    }
}
