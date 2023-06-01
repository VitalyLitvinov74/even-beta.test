<?php
declare(strict_types=1);

namespace app\DDD;

use app\Tables\MealsTable;

final class Meal
{
    public static function initial(string $name, int $price): self
    {
        $record = new MealsTable();
        $record->name = $name;
        $record->price = $price;
        $record->save();
        return new self($record->id, $name, $price);
    }

    public static function restoreByName(string $name): self
    {
        /** @var MealsTable $meal */
        $meal = MealsTable::find()->where(['name' => $name])->one();
        return new self($meal->id, $meal->name, $meal->price);
    }

    private function __construct(private int $id, private string $name, private int $price)
    {
    }

    public function price(): int
    {
        return $this->price;
    }

    public function name(): string
    {
        return $this->name;
    }
}