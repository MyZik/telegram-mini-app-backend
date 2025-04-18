<?php

declare(strict_types=1);

namespace App\Application\Model\Category;

use App\Application\Model\Item\ItemModel;

readonly class CategoryWithItemsModel
{
    /**
     * @param ItemModel[] $items
     */
    public function __construct(
        public int $id,
        public string $name,
        public string $emoji,
        public array $items,
    ) {
    }
} 