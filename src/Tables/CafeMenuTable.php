<?php
declare(strict_types=1);

namespace app\Tables;

use app\DDD\Meal;
use lhs\Yii2SaveRelationsBehavior\SaveRelationsBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * @property int $id
 * @property  int $cook_id
 * @property Meal[] $meals
 */
final class CafeMenuTable extends ActiveRecord
{
    public static function tableName(): string
    {
        return 'cafe_menu';
    }

    public function behaviors(): array
    {
        return [
            [
                'class' => SaveRelationsBehavior::class,
                'relations' => ['meals']
            ]
        ];
    }

    public function rules(): array
    {
        return [
            ['meals', 'safe']
        ];
    }

    public function getMeals(): ActiveQuery
    {
        return $this
            ->hasMany(MealsTable::class, ['id' => 'meal_id'])
            ->viaTable('cafe_menu_meals', ['cafe_menu_id' => 'id']);
    }
}