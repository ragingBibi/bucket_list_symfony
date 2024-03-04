<?php

namespace App\Repository;

use App\Entity\Wish;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;


/**
 * @extends ServiceEntityRepository<Wish>
 *
 * @method Wish|null find($id, $lockMode = null, $lockVersion = null)
 * @method Wish|null findOneBy(array $criteria, array $orderBy = null)
 * @method Wish[]    findAll()
 * @method Wish[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WishRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Wish::class);
    }

    public function getWishByAuthor($author = null, $title = null)
    {
        $query = $this->createQueryBuilder('wish');
        $query->orderBy('wish.id', 'DESC');

        if (!is_null($author)) {
            $query->andWhere('wish.author LIKE :author')
                ->setParameter('author', '%' . $author . '%');
        }

        if (!is_null($title)) {
            $query->andWhere('wish.title LIKE :title')
                ->setParameter('title', '%' . $title . '%');
        }
        $query->

    $query->setMaxResults(1);

        $query->setParameter('title', '%ti%');
        $query->setParameter('author', '%au%');

        dd($query->getQuery()->getResult());
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