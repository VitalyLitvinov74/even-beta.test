<?php
declare(strict_types=1);

namespace app\DDD;

use app\DDD\Order\Item;
use app\DDD\Order\VisitorOrder;
use app\Tables\VisitorOrdersTable;
use yii\db\ActiveRecord;

final class Waiter
{
    private function __construct()
    {
    }

    /** Сделано для единообразия */
    public static function restore(): self
    {
        return new self();
    }

    /**
     * Принять посетителя
     * @param string $visitorUuid
     * @return VisitorOrder
     */
    public function acceptVisitor(string $visitorUuid): VisitorOrder
    {
        return VisitorOrder::initial($visitorUuid);
    }

    public function bringADish(Meal $meal, int $count, string $forVisitorUuid): void
    {
        $order = $this->searchVisitorOrderByVisitorUuid($forVisitorUuid);
        if ($order === null) {
            $order = $this->acceptVisitor($forVisitorUuid);
        }
        $order->addItem(
            Item::initial(
                $meal->price(),
                $meal->name(),
                $count
            )
        );
    }

    private function searchVisitorOrderByVisitorUuid(string $visitorUuid): VisitorOrder|null
    {
        /** @var VisitorOrdersTable $visitorRecord */
        $visitorRecord = VisitorOrdersTable::find()
            ->select('id')
            ->where(['visitor_id' => $visitorUuid])
            ->one();
        return VisitorOrder::restoreById($visitorRecord->id);
    }
}