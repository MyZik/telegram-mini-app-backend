<?php

declare(strict_types=1);

namespace App\Presentation\Controller;

use App\Application\CommandHandler\Command\CreateItemCommand;
use App\Application\CommandHandler\Command\UpdateItemAvailabilityCommand;
use App\Application\QueryHandler\Query\GetItemListByCategoryQuery;
use App\Application\QueryHandler\Query\GetItemQuery;
use App\Presentation\Request\Item\CreateItemRequest;
use App\Presentation\Request\Item\UpdateItemAvailabilityRequest;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/api/items')]
class ItemController extends ApiController
{
    use HandleTrait;

    public function __construct(
        private MessageBusInterface $messageBus,
        SerializerInterface $serializer,
    ) {
        parent::__construct($serializer);
        $this->messageBus = $messageBus;
    }

    #[Route('/category/{categoryId}', methods: ['GET'])]
    public function getItemsByCategory(int $categoryId): Response
    {
        $query = new GetItemListByCategoryQuery(categoryId: $categoryId);
        $items = $this->handle($query);

        return $this->json($items);
    }

    #[Route('/{id}', methods: ['GET'])]
    public function getItem(int $id): Response
    {
        $query = new GetItemQuery(id: $id);
        $item = $this->handle($query);

        return $this->json($item);
    }

    #[Route('', methods: ['POST'])]
    public function createItem(Request $request): Response
    {
        /** @var CreateItemRequest $createItemRequest */
        $createItemRequest = $this->serializer->deserialize(
            $request->getContent(),
            CreateItemRequest::class,
            'json'
        );

        $command = new CreateItemCommand(
            name: $createItemRequest->name,
            emoji: $createItemRequest->emoji,
            isAvailable: $createItemRequest->isAvailable,
            categoryId: $createItemRequest->categoryId,
        );

        $itemId = $this->handle($command);

        return $this->json(['id' => $itemId], Response::HTTP_CREATED);
    }

    #[Route('/{id}/availability', methods: ['PATCH'])]
    public function updateItemAvailability(int $id, Request $request): Response
    {
        /** @var UpdateItemAvailabilityRequest $updateItemAvailabilityRequest */
        $updateItemAvailabilityRequest = $this->serializer->deserialize(
            $request->getContent(),
            UpdateItemAvailabilityRequest::class,
            'json'
        );

        $command = new UpdateItemAvailabilityCommand(
            id: $id,
            isAvailable: $updateItemAvailabilityRequest->isAvailable,
        );

        $this->handle($command);

        return $this->json(null, Response::HTTP_NO_CONTENT);
    }
}
