<?php

declare(strict_types=1);

namespace App\Application\CommandHandler;

use App\Application\CommandHandler\Command\CreateItemCommand;
use App\Application\Rule\Category\FindCategoryByIdRule;
use App\Application\Rule\Item\SaveItemRule;
use App\Domain\Entity\Item;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
readonly class CreateItemCommandHandler
{
    public function __construct(
        private FindCategoryByIdRule $findCategoryByIdRule,
        private SaveItemRule $saveItemRule,
    ) {
    }

    public function __invoke(CreateItemCommand $command): int
    {
        $category = $this->findCategoryByIdRule->execute($command->categoryId);

        $item = new Item(
            name: $command->name,
            emoji: $command->emoji,
            isAvailable: $command->isAvailable,
            category: $category,
        );

        $this->saveItemRule->execute($item);

        $id = $item->getId();

        if ($id === null) {
            throw new \LogicException('Item ID should not be null after saving');
        }

        return $id;
    }
} 
