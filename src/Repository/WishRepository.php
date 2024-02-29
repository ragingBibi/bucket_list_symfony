<?php

namespace App\Repository;

use App\Entity\Wish;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class WishRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Wish::class);
    }

    public function getWishesByPage(int $page, int $maxPerPage): array
    {
        $query = $this->createQueryBuilder('wish')
            ->andWhere('wish.isPublished = :published')->setParameter('published', true)
            ->orderBy('wish.dateCreated', 'DESC');

        // Pagination
        $query->setMaxResults($maxPerPage);
        $query->setFirstResult($maxPerPage * ($page - 1));

        return $query->getQuery()->getResult();
    }

    public function getWishById(int $id): ?Wish
    {
        $query = $this->createQueryBuilder('wish')
            ->where('wish.id = :id')->setParameter('id', $id)
            ->andWhere('wish.isPublished = :published')->setParameter('published', true);

        return $query->getQuery()->getOneOrNullResult();
    }
}