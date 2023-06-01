<?php
declare(strict_types=1);

namespace app\Domain;

use app\Tables\CafeMenuTable;
use app\Tables\CookCafeMenuTable;
use app\Tables\CooksTable;
use yii\db\ActiveRecord;

final class CafeMenu implements PersistInterface
{
    /**
     * @param Meal[] $preparedMeals
     */
    public function __construct(private string $cookUuid, private array $preparedMeals)
    {
    }

    public function addMealToMenu(Meal $meal): void
    {
        $this->preparedMeals[] = $meal;
    }

    public function persist(): ActiveRecord
    {
        $menu = CafeMenuTable::find()
            ->where([
                'id' => CookCafeMenuTable::find()
                    ->select('cafe_menu_id')
                    ->where([
                        'cook_id' => CooksTable::find()
                            ->select('uuid')
                            ->where(['uuid' => $this->cookUuid])
                    ])
            ])
            ->one();
        if ($menu === null) {
            $menu = new CafeMenuTable();
        }
        $meals = [];
        foreach ($this->preparedMeals as $meal) {
            $meals[] = $meal->persist();
        }
        $menu->meals = $meals;
        $menu->save();
        return $menu;
    }
}