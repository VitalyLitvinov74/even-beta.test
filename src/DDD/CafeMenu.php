<?php
declare(strict_types=1);

namespace app\DDD;

use app\Tables\CafeMenuTable;
use app\Tables\CookCafeMenuTable;
use app\Tables\MealsTable;

final class CafeMenu
{
    private function __construct(private int $cookId)
    {
    }

    public static function restoreByCookId(int $cookId): self{

        return new self($cookId);
    }

    public function addMealToMenu(Meal $meal): void
    {
        $recordCafeMenu = self::record($this->cookId);
        $mealRecord = MealsTable::find()->where(['name'=>$meal->name()])->one();
        $recordCafeMenu->meals = array_merge([$mealRecord], $recordCafeMenu->meals);
        $recordCafeMenu->save();
    }

    private static function record(int $cookId): CafeMenuTable{
        /** @var CafeMenuTable $recordCafeMenu */
        $recordCafeMenu = CafeMenuTable::find()
            ->where(['cook_id'=>$cookId])
            ->one();
        return $recordCafeMenu;
    }
}