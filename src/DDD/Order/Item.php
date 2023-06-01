<?php
declare(strict_types=1);

namespace app\DDD\Order;

use app\Domain\Meal;
use app\Domain\PersistInterface;
use app\Tables\MealsTable;
use app\Tables\VisitorOrderItemsTable;

final class Item implements PersistInterface
{
    public function __construct(
        private int $itemPrice,
        private string $mealName,
        private int $count,
    )
    {
    }

    public function summaryPrice(): int{
        return $this->itemPrice * $this->count;
    }

    public function persist(): VisitorOrderItemsTable
    {
        $mealId = MealsTable::find()
            ->select('id')
            ->where(['name'=>$this->mealName])
            ->scalar();
        $item = new VisitorOrderItemsTable();
        $item->price = $this->itemPrice;
        $item->meal_id = $mealId;
        $item->count = $this->count;
        $item->summary_price = $this->summaryPrice();
        $item->save();
        return $item;
    }
}