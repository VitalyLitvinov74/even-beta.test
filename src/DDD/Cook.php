<?php
declare(strict_types=1);

namespace app\DDD;

use app\Tables\CafeMenuTable;
use app\Tables\CooksTable;

final class Cook
{
    private function __construct(private int $id)
    {

    }

    public static function initial(string $name, string $uuid): self
    {
        $record = new CooksTable();
        $record->name = $name;
        $record->uuid = $uuid;
        $record->cafeMenu = new CafeMenuTable([]);
        $record->save();
        return new self($record->id);
    }

    public static function restoreById(int $id): self
    {
        return new self($id);
    }


    public function makeADish(string $name, int $price): Meal
    {
        /** @var CooksTable $cookRecord */
        $cookRecord = CooksTable::find()
            ->where(['id' => $this->id])
            ->one();
        $cafeMenu = CafeMenu::restoreByCookId($this->id);
        $meal = Meal::initial($name, $price);
        $cafeMenu->addMealToMenu($meal);
        $cookRecord->save();
        return $meal;
    }
}