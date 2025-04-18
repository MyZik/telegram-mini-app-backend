<?php

declare(strict_types=1);

namespace App\Application\Rule\Category;

use App\Domain\Entity\Category;
use App\Domain\Repository\CategoryRepository;

readonly class FindCategoryByIdRule
{
    public function __construct(
        private CategoryRepository $categoryRepository,
    ) {
    }

    public function execute(int $id): Category
    {
        $category = $this->categoryRepository->find($id);

        if ($category === null) {
            throw new \InvalidArgumentException(sprintf('Category with ID %d not found', $id));
        }

        return $category;
    }
} 