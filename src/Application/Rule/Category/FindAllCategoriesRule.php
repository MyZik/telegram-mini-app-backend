<?php

declare(strict_types=1);

namespace App\Application\Rule\Category;

use App\Domain\Entity\Category;
use App\Domain\Repository\CategoryRepository;

readonly class FindAllCategoriesRule
{
    public function __construct(
        private CategoryRepository $categoryRepository,
    ) {
    }

    /**
     * @return Category[]
     */
    public function execute(): array
    {
        return $this->categoryRepository->findAllOrderedByName();
    }
} 