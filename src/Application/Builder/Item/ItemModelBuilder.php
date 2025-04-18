<?php

declare(strict_types=1);

namespace App\Application\Builder\Item;

use App\Application\Model\Item\ItemModel;
use App\Domain\Entity\Item;

class ItemModelBuilder
{
    public function buildFromEntity(Item $item): ItemModel
    {
        $category = $item->getCategory();
        
        if ($category === null) {
            throw new \LogicException('Item category should not be null');
        }
        
        $categoryId = $category->getId();
        
        if ($categoryId === null) {
            throw new \LogicException('Category ID should not be null');
        }
        
        return new ItemModel(
            id: $item->getId() ?? throw new \LogicException('Item ID should not be null'),
            name: $item->getName(),
            emoji: $item->getEmoji(),
            isAvailable: $item->isAvailable(),
            categoryId: $categoryId,
        );
    }

    /**
     * @param Item[] $items
     * @return ItemModel[]
     */
    public function buildFromEntities(array $items): array
    {
        return array_map(
            fn (Item $item) => $this->buildFromEntity($item),
            $items
        );
    }
} 