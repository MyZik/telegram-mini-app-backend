<?php

declare(strict_types=1);

namespace App\Application\QueryHandler;

use App\Application\Builder\Category\CategoryModelBuilder;
use App\Application\Model\Category\CategoryModel;
use App\Application\QueryHandler\Query\GetCategoryListQuery;
use App\Application\Rule\Category\FindAllCategoriesRule;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
readonly class GetCategoryListQueryHandler
{
    public function __construct(
        private FindAllCategoriesRule $findAllCategoriesRule,
        private CategoryModelBuilder $categoryModelBuilder,
    ) {
    }

    /**
     * @return CategoryModel[]
     */
    public function __invoke(GetCategoryListQuery $query): array
    {
        $categories = $this->findAllCategoriesRule->execute();
        
        return $this->categoryModelBuilder->buildFromEntities($categories);
    }
} 
