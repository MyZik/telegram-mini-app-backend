<?php

declare(strict_types=1);

namespace App\Application\CommandHandler;

use App\Application\CommandHandler\Command\UpdateItemAvailabilityCommand;
use App\Application\Rule\Item\FindItemByIdRule;
use App\Application\Rule\Item\SaveItemRule;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
readonly class UpdateItemAvailabilityCommandHandler
{
    public function __construct(
        private FindItemByIdRule $findItemByIdRule,
        private SaveItemRule $saveItemRule,
    ) {
    }

    public function __invoke(UpdateItemAvailabilityCommand $command): void
    {
        $item = $this->findItemByIdRule->execute($command->id);
        $item->setIsAvailable($command->isAvailable);
        $this->saveItemRule->execute($item);
    }
} 
