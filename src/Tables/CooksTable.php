<?php
declare(strict_types=1);

namespace app\Tables;

use app\Domain\Meal;
use lhs\Yii2SaveRelationsBehavior\SaveRelationsBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * @property int id
 * @property string name
 * @property string uuid
 * @property Meal[] $meals
 */
final class CooksTable extends ActiveRecord
{
    public function behaviors(): array
    {
        return [
            [
                'class' => SaveRelationsBehavior::class,
                'relations' => [
                    'meals'
                ]
            ]
        ];
    }

    public function rules(): array
    {
        return [
            ['meals', 'safe']
        ];
    }

    public static function tableName(): string
    {
        return 'cooks';
    }

    public function getMeals(): ActiveQuery
    {
        return $this->hasMany(MealsTable::class, ['id' => 'meal_id'])
            ->viaTable('cook_meal', ['cook_id' => 'id']);
    }
}