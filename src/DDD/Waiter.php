<?php
declare(strict_types=1);

namespace app\Domain;

use app\DDD\Order\Item;
use app\DDD\Order\VisitorOrder;

final class Waiter implements PersistInterface
{
    /**
     * @var VisitorOrder[]
     */
    private array $visitorOrders;

    public function __construct()
    {
    }

    public function createOrder(string $forVisitorUuid): VisitorOrder
    {
        return new VisitorOrder($forVisitorUuid);
    }

    public function bringADish(Meal $meal, int $count, string $forVisitorUuid): void
    {
        $order = $this->searchVisitorOrderByVisitorUuid($forVisitorUuid);
        $order->addItem(
            new Item(
                $meal->price(),
                $meal->name(),
                $count,
                $forVisitorUuid
            )
        );
    }

    private function searchVisitorOrderByVisitorUuid(string $visitorUuid): VisitorOrder{

    }

    public function persist(): void
    {
        foreach ($this->visitorOrders as $order){
            $order->persist();
        }
    }
}