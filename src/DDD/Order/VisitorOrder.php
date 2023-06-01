<?php
declare(strict_types=1);

namespace app\DDD\Order;

use app\Tables\VisitorOrdersTable;

final class VisitorOrder
{

    private function __construct(private int $orderId)
    {
    }

    public static function initial(string $visitorUuid): self
    {
        $record = new VisitorOrdersTable();
        $record->visitor_uuid = $visitorUuid;
        $record->summary_price = 0;
        $record->save();
        return self::restoreById($record->id);
    }

    public static function restoreById(int $visitorOrderId): self
    {
        return new self($visitorOrderId);
    }

    public function addItem(Item $item): self
    {
        /** @var VisitorOrdersTable $recordVisitorOrder */
        $recordVisitorOrder = VisitorOrdersTable::find()->where(['id'=>$this->orderId])->one();
        $recordVisitorOrder->items[] = $item->id();
        $recordVisitorOrder->summary_price += $item->summaryPrice();
        $recordVisitorOrder->save();
        return $this;
    }
}