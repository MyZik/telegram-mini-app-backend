<?php

declare(strict_types=1);

namespace App\Application\CommandHandler\Command;

readonly class CreateItemCommand
{
    public function __construct(
        public string $name,
        public string $emoji,
        public bool $isAvailable,
        public int $categoryId,
    ) {
    }
} 
