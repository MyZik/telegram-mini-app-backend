<?php

declare(strict_types=1);

namespace App\Presentation\Request\Category;

use Symfony\Component\Validator\Constraints as Assert;

readonly class CreateCategoryRequest
{
    public function __construct(
        #[Assert\NotBlank]
        #[Assert\Length(min: 1, max: 255)]
        public string $name,
        
        #[Assert\NotBlank]
        #[Assert\Length(min: 1, max: 10)]
        public string $emoji,
    ) {
    }
} 