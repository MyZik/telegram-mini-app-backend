<?php

declare(strict_types=1);

namespace App\Application\QueryHandler;

use App\Application\Builder\Item\ItemModelBuilder;
use App\Application\Model\Item\ItemModel;
use App\Application\QueryHandler\Query\GetItemListByCategoryQuery;
use App\Application\Rule\Category\FindCategoryByIdRule;
use App\Application\Rule\Item\FindItemsByCategoryRule;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
readonly class GetItemListByCategoryQueryHandler
{
    public function __construct(
        private FindCategoryByIdRule $findCategoryByIdRule,
        private FindItemsByCategoryRule $findItemsByCategoryRule,
        private ItemModelBuilder $itemModelBuilder,
    ) {
    }

    /**
     * @return ItemModel[]
     */
    public function __invoke(GetItemListByCategoryQuery $query): array
    {
        $category = $this->findCategoryByIdRule->execute($query->categoryId);
        $items = $this->findItemsByCategoryRule->execute($category);
        
        return $this->itemModelBuilder->buildFromEntities($items);
    }
} 
