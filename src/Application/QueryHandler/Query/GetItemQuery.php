<?php

declare(strict_types=1);

namespace App\Application\QueryHandler\Query;

readonly class GetItemQuery
{
    public function __construct(
        public int $id,
    ) {
    }
} 
