<?php
declare(strict_types=1);

namespace app\Tables;

use yii\db\ActiveRecord;

/**
 * @property int id
 * @property int cook_id
 * @property int meal_id
 */
final class CookMealTable extends ActiveRecord
{
    public static function tableName(): string
    {
        return 'cook_meal';
    }
}