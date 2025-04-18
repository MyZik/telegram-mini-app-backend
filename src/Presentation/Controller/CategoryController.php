<?php

declare(strict_types=1);

namespace App\Presentation\Controller;

use App\Application\CommandHandler\Command\CreateCategoryCommand;
use App\Application\QueryHandler\Query\GetCategoryListQuery;
use App\Application\QueryHandler\Query\GetCategoryQuery;
use App\Presentation\Request\Category\CreateCategoryRequest;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/api/categories')]
class CategoryController extends ApiController
{
    use HandleTrait;

    public function __construct(
        private MessageBusInterface $messageBus,
        SerializerInterface $serializer,
    ) {
        parent::__construct($serializer);
        $this->messageBus = $messageBus;
    }

    #[Route('', methods: ['GET'])]
    public function getCategories(): Response
    {
        $query = new GetCategoryListQuery();
        $categories = $this->handle($query);

        return $this->json($categories);
    }

    #[Route('/{id}', methods: ['GET'])]
    public function getCategory(int $id): Response
    {
        $query = new GetCategoryQuery(id: $id);
        $category = $this->handle($query);

        return $this->json($category);
    }

    #[Route('', methods: ['POST'])]
    public function createCategory(Request $request): Response
    {
        /** @var CreateCategoryRequest $createCategoryRequest */
        $createCategoryRequest = $this->serializer->deserialize(
            $request->getContent(),
            CreateCategoryRequest::class,
            'json'
        );

        $command = new CreateCategoryCommand(
            name: $createCategoryRequest->name,
            emoji: $createCategoryRequest->emoji,
        );

        $categoryId = $this->handle($command);

        return $this->json(['id' => $categoryId], Response::HTTP_CREATED);
    }
} 
