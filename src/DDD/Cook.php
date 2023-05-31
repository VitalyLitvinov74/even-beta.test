<?php
declare(strict_types=1);

namespace app\Domain;


use app\Tables\CookMealTable;
use app\Tables\CooksTable;
use app\Tables\MealsTable;

final class Cook
{
    public function __construct(private string $name)
    {
    }

    public function makeADish(string $name, int $price): Meal
    {
        return new Meal($name, $price);
    }

    public function createAMenu(): CafeMenu
    {
        return new CafeMenu($this->preparedMeals());
    }

    /**
     * @return Meal[]
     */
    private function preparedMeals(): array
    {
        $mealRecords = MealsTable::find()
            ->select(['name', 'price'])
            ->where([
                'id' => CookMealTable::find()
                    ->select('meal_id')
                    ->where([
                        'cook_id' => CooksTable::find()
                            ->select('id')
                            ->where(['name' => $this->name])
                    ])
            ])
            ->asArray()
            ->all();
        $meals = [];
        foreach ($mealRecords as $mealRecord) {
            $meals[] = new Meal(
                $mealRecord['name'],
                $mealRecord['price']
            );
        }
        return $meals;
    }
}