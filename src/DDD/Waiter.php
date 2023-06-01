<?php
declare(strict_types=1);

namespace app\Domain;

use app\DDD\Order\Item;
use app\DDD\Order\VisitorOrder;
use yii\db\ActiveRecord;

final class Waiter implements PersistInterface
{
    /**
     * @var VisitorOrder[]
     */
    private array $visitorOrders;

    public function __construct()
    {
    }

    /**
     * @param string $forVisitorUuid
     * @return VisitorOrder
     */
    public function acceptVisitor(string $forVisitorUuid): VisitorOrder
    {
        $visitorOrder = new VisitorOrder($forVisitorUuid);
        $this->visitorOrders[] = $visitorOrder;
        return $visitorOrder;
    }

    public function bringADish(Meal $meal, int $count, string $forVisitorUuid): void
    {
        $order = $this->searchVisitorOrderByVisitorUuid($forVisitorUuid);
        if ($order === null) {
            $order = $this->acceptVisitor($forVisitorUuid);
        }
        $order->addItem(
            new Item(
                $meal->price(),
                $meal->name(),
                $count,
            )
        );
    }

    private function searchVisitorOrderByVisitorUuid(string $visitorUuid): VisitorOrder|null
    {
        foreach ($this->visitorOrders as $visitorOrder) {
            if ($visitorOrder->registeredOnVisitor($visitorUuid)) {
                return $visitorOrder;
            }
        }
        return null;
    }

    public function persist(): ActiveRecord
    {
        foreach ($this->visitorOrders as $order) {
            $order->persist();
        }
        return new ActiveRecord();
    }
}