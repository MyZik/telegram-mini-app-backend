<?php

declare(strict_types=1);

namespace App\Application\Builder\Category;

use App\Application\Model\Category\CategoryModel;
use App\Domain\Entity\Category;

class CategoryModelBuilder
{
    public function buildFromEntity(Category $category): CategoryModel
    {
        return new CategoryModel(
            id: $category->getId() ?? throw new \LogicException('Category ID should not be null'),
            name: $category->getName(),
            emoji: $category->getEmoji(),
        );
    }

    /**
     * @param Category[] $categories
     * @return CategoryModel[]
     */
    public function buildFromEntities(array $categories): array
    {
        return array_map(
            fn (Category $category) => $this->buildFromEntity($category),
            $categories
        );
    }
} 