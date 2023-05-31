<?php
declare(strict_types=1);

namespace app\DDD\Order;

use app\Domain\PersistInterface;

final class VisitorOrder implements PersistInterface
{
    private array $items;
    private string $visitorUuid;

    public function __construct(string $visitorUuid)
    {
        $this->items = [];
    }

    public function addItem(Item $item): self
    {
        $this->items[] = $item;
        return $this;
    }

    public function persist(): void
    {
        foreach ($this->items as $item){
            $item->persist();
        }
    }
}