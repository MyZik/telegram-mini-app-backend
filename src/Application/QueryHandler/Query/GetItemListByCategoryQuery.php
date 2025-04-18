<?php

declare(strict_types=1);

namespace App\Application\QueryHandler\Query;

readonly class GetItemListByCategoryQuery
{
    public function __construct(
        public int $categoryId,
    ) {
    }
} 
