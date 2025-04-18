<?php

declare(strict_types=1);

namespace App\Application\Rule\Category;

use App\Domain\Entity\Category;
use App\Domain\Repository\CategoryRepository;

readonly class SaveCategoryRule
{
    public function __construct(
        private CategoryRepository $categoryRepository,
    ) {
    }

    public function execute(Category $category): void
    {
        $this->categoryRepository->save($category, true);
    }
}