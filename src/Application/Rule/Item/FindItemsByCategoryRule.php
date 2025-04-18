<?php

declare(strict_types=1);

namespace App\Application\Rule\Item;

use App\Domain\Entity\Category;
use App\Domain\Entity\Item;
use App\Domain\Repository\ItemRepository;

readonly class FindItemsByCategoryRule
{
    public function __construct(
        private ItemRepository $itemRepository,
    ) {
    }

    /**
     * @return Item[]
     */
    public function execute(Category $category): array
    {
        return $this->itemRepository->findByCategoryOrderedByName($category);
    }
} 