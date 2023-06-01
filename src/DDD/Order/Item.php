<?php
declare(strict_types=1);

namespace app\DDD\Order;

use app\Domain\Meal;
use app\Domain\PersistInterface;
use app\Tables\MealsTable;
use app\Tables\VisitorOrderItemsTable;

final class Item
{
    public static function restoreById(int $id): self
    {
        /** @var VisitorOrderItemsTable $record */
        $record = VisitorOrderItemsTable::find()
            ->where(['id' => $id])
            ->one();
        return new self($record->id, $record->price, $record->count);
    }

    public static function initial(int $itemPrice, string $mealName, int $count): self
    {
        $mealId = MealsTable::find()
            ->select('id')
            ->where(['name' => $mealName])
            ->scalar();
        $record = new VisitorOrderItemsTable();
        $record->price = $itemPrice;
        $record->count = $count;
        $record->summary_price = $itemPrice * $count;
        $record->meal_id = $mealId;
        $record->save();
        return self::restoreById($record->id);
    }

    private function __construct(
        private int $id,
        private int $itemPrice,
        private int $count,
    ) {
    }

    public function id(): int
    {
        return $this->id;
    }

    public function summaryPrice(): int
    {
        return $this->itemPrice * $this->count;
    }
}