<?php

declare(strict_types=1);

namespace App\Application\QueryHandler\Query;

readonly class GetCategoryQuery
{
    public function __construct(
        public int $id,
    ) {
    }
} 
