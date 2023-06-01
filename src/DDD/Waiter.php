<?php
declare(strict_types=1);

namespace app\DDD;

use app\DDD\Order\Item;
use app\DDD\Order\VisitorOrder;
use app\Tables\VisitorOrdersTable;
use yii\db\ActiveRecord;
use yii\helpers\VarDumper;

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
        $visitorOrderId = VisitorOrdersTable::find()
            ->select('id')
            ->where(['visitor_uuid' => $visitorUuid])
            ->scalar();
        return VisitorOrder::restoreById($visitorOrderId);
    }
}