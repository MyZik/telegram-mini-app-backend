<?php

declare(strict_types=1);

namespace App\Application\QueryHandler;

use App\Application\Builder\Item\ItemModelBuilder;
use App\Application\Model\Item\ItemModel;
use App\Application\QueryHandler\Query\GetItemQuery;
use App\Application\Rule\Item\FindItemByIdRule;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
readonly class GetItemQueryHandler
{
    public function __construct(
        private FindItemByIdRule $findItemByIdRule,
        private ItemModelBuilder $itemModelBuilder,
    ) {
    }

    public function __invoke(GetItemQuery $query): ItemModel
    {
        $item = $this->findItemByIdRule->execute($query->id);
        
        return $this->itemModelBuilder->buildFromEntity($item);
    }
} 
