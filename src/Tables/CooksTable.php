<?php
declare(strict_types=1);

namespace app\Tables;

use app\Domain\Meal;
use lhs\Yii2SaveRelationsBehavior\SaveRelationsBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\widgets\Menu;

/**
 * @property int id
 * @property string name
 * @property string uuid
 * @property Meal[] $meals
 * @property CafeMenuTable cafeMenu
 */
final class CooksTable extends ActiveRecord
{
    public function behaviors(): array
    {
        return [
            [
                'class' => SaveRelationsBehavior::class,
                'relations' => [
                    'meals',
                    'cafeMenu'
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

    public function getCafeMenu(): ActiveQuery{
        return $this
            ->hasOne(CafeMenuTable::class,['id'=>'cafe_menu_id'])
            ->viaTable('cook_cafe_menu', ['cook_id'=>'id']);
    }
}