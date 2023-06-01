<?php
declare(strict_types=1);

namespace app\Domain;

use app\Tables\CafeMenuTable;
use app\Tables\CooksTable;

final class Cook implements PersistInterface
{
    private CafeMenu $cafeMenu;

    public static function restoreById(int $id): self
    {
        /** @var CooksTable $cookRecord */
        $cookRecord = CooksTable::find()
            ->where(['id'=>$id])
            ->one();
        return new self($cookRecord->name, $cookRecord->uuid);
    }

    public function __construct(private string $name, private string $uuid)
    {
        $this->cafeMenu = new CafeMenu($this->uuid, []);
    }

    public function makeADish(string $name, int $price): Meal
    {
        $meal = new Meal($name, $price);
        $this->cafeMenu->addMealToMenu($meal);
        return $meal;
    }

    public function persist(): CooksTable
    {
        /** @var CooksTable $cook */
        $cook = CooksTable::find()->where(['uuid'=>$this->uuid])->one();
        if($cook === null){
            $cook = new CooksTable();
            $cook->name = $this->name;
        }
        /** @var CafeMenuTable $cafeMenu */
        $cafeMenu = $this->cafeMenu->persist();
        $cook->cafeMenu = $cafeMenu;
        $cook->meals = $cafeMenu->meals;
        $cook->save();
        return $cook;
    }
}