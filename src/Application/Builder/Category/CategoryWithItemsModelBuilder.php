<?php

declare(strict_types=1);

namespace App\Application\Builder\Category;

use App\Application\Builder\Item\ItemModelBuilder;
use App\Application\Model\Category\CategoryWithItemsModel;
use App\Domain\Entity\Category;

class CategoryWithItemsModelBuilder
{
    public function __construct(
        private readonly ItemModelBuilder $itemModelBuilder,
    ) {
    }

    public function buildFromEntity(Category $category): CategoryWithItemsModel
    {
        return new CategoryWithItemsModel(
            id: $category->getId() ?? throw new \LogicException('Category ID should not be null'),
            name: $category->getName(),
            emoji: $category->getEmoji(),
            items: $this->itemModelBuilder->buildFromEntities($category->getItems()->toArray()),
        );
    }

    /**
     * @param Category[] $categories
     * @return CategoryWithItemsModel[]
     */
    public function buildFromEntities(array $categories): array
    {
        return array_map(
            fn (Category $category) => $this->buildFromEntity($category),
            $categories
        );
    }
} 