<?php

declare(strict_types=1);

namespace App\Domain\Repository;

use App\Domain\Entity\Category;
use App\Domain\Entity\Item;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Item>
 */
class ItemRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Item::class);
    }

    public function save(Item $item, bool $flush = false): void
    {
        $this->getEntityManager()->persist($item);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Item $item, bool $flush = false): void
    {
        $this->getEntityManager()->remove($item);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * @return Item[]
     */
    public function findByCategoryOrderedByName(Category $category): array
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.category = :category')
            ->setParameter('category', $category)
            ->orderBy('i.name', 'ASC')
            ->getQuery()
            ->getResult();
    }

    /**
     * @return Item[]
     */
    public function findByAvailability(bool $isAvailable): array
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.isAvailable = :isAvailable')
            ->setParameter('isAvailable', $isAvailable)
            ->orderBy('i.name', 'ASC')
            ->getQuery()
            ->getResult();
    }
} 