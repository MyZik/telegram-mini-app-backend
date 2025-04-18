<?php

declare(strict_types=1);

namespace App\Domain\Entity;

use App\Domain\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
#[ORM\Table(name: 'categories')]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "SEQUENCE")]
    #[ORM\SequenceGenerator(sequenceName: "categories_id_seq", allocationSize: 1)]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private string $name;

    #[ORM\Column(length: 10)]
    private string $emoji;

    #[ORM\OneToMany(mappedBy: 'category', targetEntity: Item::class, orphanRemoval: true)]
    private Collection $items;

    public function __construct(string $name, string $emoji)
    {
        $this->name = $name;
        $this->emoji = $emoji;
        $this->items = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getEmoji(): string
    {
        return $this->emoji;
    }

    public function setEmoji(string $emoji): void
    {
        $this->emoji = $emoji;
    }

    /**
     * @return Collection<int, Item>
     */
    public function getItems(): Collection
    {
        return $this->items;
    }

    public function addItem(Item $item): void
    {
        if (!$this->items->contains($item)) {
            $this->items->add($item);
            $item->setCategory($this);
        }
    }

    public function removeItem(Item $item): void
    {
        if ($this->items->removeElement($item)) {
            if ($item->getCategory() === $this) {
                $item->setCategory(null);
            }
        }
    }
} 