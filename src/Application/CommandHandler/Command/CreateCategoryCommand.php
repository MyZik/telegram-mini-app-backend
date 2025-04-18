<?php

declare(strict_types=1);

namespace App\Application\CommandHandler\Command;

readonly class CreateCategoryCommand
{
    public function __construct(
        public string $name,
        public string $emoji,
    ) {
    }
} 
