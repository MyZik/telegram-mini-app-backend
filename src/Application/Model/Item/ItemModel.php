<?php

declare(strict_types=1);

namespace App\Application\Model\Item;

readonly class ItemModel
{
    public function __construct(
        public int $id,
        public string $name,
        public string $emoji,
        public bool $isAvailable,
        public int $categoryId,
    ) {
    }
} 