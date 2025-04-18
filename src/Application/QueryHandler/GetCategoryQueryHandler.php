<?php

declare(strict_types=1);

namespace App\Application\QueryHandler;

use App\Application\Builder\Category\CategoryWithItemsModelBuilder;
use App\Application\Model\Category\CategoryWithItemsModel;
use App\Application\QueryHandler\Query\GetCategoryQuery;
use App\Application\Rule\Category\FindCategoryByIdRule;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
readonly class GetCategoryQueryHandler
{
    public function __construct(
        private FindCategoryByIdRule $findCategoryByIdRule,
        private CategoryWithItemsModelBuilder $categoryWithItemsModelBuilder,
    ) {
    }

    public function __invoke(GetCategoryQuery $query): CategoryWithItemsModel
    {
        $category = $this->findCategoryByIdRule->execute($query->id);
        
        return $this->categoryWithItemsModelBuilder->buildFromEntity($category);
    }
} 
