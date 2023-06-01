<?php
declare(strict_types=1);

namespace app\DDD\Order;

use app\Domain\PersistInterface;
use app\Tables\VisitorOrdersTable;

final class VisitorOrder implements PersistInterface
{
    private array $items;
    private string $visitorUuid;

    public function __construct(string $visitorUuid)
    {
        $this->items = [];
        $this->visitorUuid = $visitorUuid;
    }

    public function addItem(Item $item): self
    {
        $this->items[] = $item;
        return $this;
    }

    public function registeredOnVisitor(string $visitorUuid): bool
    {
        if ($this->visitorUuid === $visitorUuid) {
            return true;
        }
        return false;
    }

    public function persist(): VisitorOrdersTable
    {
        /** @var VisitorOrdersTable $order */
        $order = VisitorOrdersTable::find()->where(['visitorUuid' => $this->visitorUuid])->one();
        if ($order === null) {
            $order = new VisitorOrdersTable();
            $order->visitor_id = $this->visitorUuid;
        }
        $items = [];
        foreach ($this->items as $item) {
            $items[] = $item->persist();
        }
        $order->items = $items;
        $order->save();
        return $order;
    }
}