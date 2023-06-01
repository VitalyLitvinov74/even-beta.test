<?php
declare(strict_types=1);

namespace app\Domain;

use yii\db\ActiveRecord;

final class CafeMenu implements PersistInterface
{
    /**
     * @param Meal[] $preparedMeals
     */
    public function __construct(private array $preparedMeals)
    {
    }

    public function addMealToMenu(Meal $meal): void
    {
        $this->preparedMeals[] = $meal;
    }

    public function persist(): ActiveRecord
    {
        foreach ($this->preparedMeals as $meal){
            $meal->persist();
        }
    }
}