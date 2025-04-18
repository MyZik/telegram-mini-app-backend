<?php

declare(strict_types=1);

namespace App\Application\CommandHandler;

use App\Application\CommandHandler\Command\CreateCategoryCommand;
use App\Application\Rule\Category\SaveCategoryRule;
use App\Domain\Entity\Category;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
readonly class CreateCategoryCommandHandler
{
    public function __construct(
        private SaveCategoryRule $saveCategoryRule,
    ) {
    }

    public function __invoke(CreateCategoryCommand $command): int
    {
        $category = new Category(
            name: $command->name,
            emoji: $command->emoji,
        );

        $this->saveCategoryRule->execute($category);

        $id = $category->getId();

        if ($id === null) {
            throw new \LogicException('Category ID should not be null after saving');
        }

        return $id;
    }
} 
