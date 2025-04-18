<?php

declare(strict_types=1);

namespace App\Application\CommandHandler\Command;

readonly class UpdateItemAvailabilityCommand
{
    public function __construct(
        public int $id,
        public bool $isAvailable,
    ) {
    }
} 
