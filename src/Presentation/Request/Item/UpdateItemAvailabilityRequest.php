<?php

declare(strict_types=1);

namespace App\Presentation\Request\Item;

use Symfony\Component\Validator\Constraints as Assert;

readonly class UpdateItemAvailabilityRequest
{
    public function __construct(
        #[Assert\NotNull]
        public bool $isAvailable,
    ) {
    }
} 