<?php

declare(strict_types=1);

namespace App\Application\Rule\Item;

use App\Domain\Entity\Item;
use App\Domain\Repository\ItemRepository;

readonly class FindItemByIdRule
{
    public function __construct(
        private ItemRepository $itemRepository,
    ) {
    }

    public function execute(int $id): Item
    {
        $item = $this->itemRepository->find($id);

        if ($item === null) {
            throw new \InvalidArgumentException(sprintf('Item with ID %d not found', $id));
        }

        return $item;
    }
} 