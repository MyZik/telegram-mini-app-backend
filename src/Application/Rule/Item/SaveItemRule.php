<?php

declare(strict_types=1);

namespace App\Application\Rule\Item;

use App\Domain\Entity\Item;
use App\Domain\Repository\ItemRepository;

readonly class SaveItemRule
{
    public function __construct(
        private ItemRepository $itemRepository,
    ) {
    }

    public function execute(Item $item): void
    {
        $this->itemRepository->save($item, true);
    }
} 